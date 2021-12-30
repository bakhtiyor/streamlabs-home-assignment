<?php

namespace App\Repository\API;

use App;
use App\Models\Stream;
use App\Models\Tag;
use App\Repository\Twitch;
use App\Repository\TwitchRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Http;
use Illuminate\Database\Eloquent\Collection;
use Log;
use Monolog\Logger;

class TwitchRepository extends Twitch implements TwitchRepositoryInterface
{
    private $handler;

    public function initHttp($url, $headers)
    {
        $this->init($url, [
                'Authorization' => "Bearer ".$headers['token'],
                'Client-Id' => $headers['client_id']
            ]);
        $this->handler = HandlerStack::create();
        $logChannel = app()->get('log')->channel('daily');
        $this->handler->push(
            Middleware::log(
                $logChannel,
                new MessageFormatter('{uri} - {req_body} - {res_body}')
            )
        );
    }

    public function fetchListOfTags()
    {
        $hasNextPage = true; $cursor = null; $options = ['first'=>100];
        while($hasNextPage){
            if (!is_null($cursor)) $options['after'] = $cursor;
            $Http = Http::withHeaders(parent::getHeaders())->acceptJson();
            if (App::environment('local')){
                $Http->setHandler($this->handler);
            }
            $response = $Http->get($this->getTagURL(), $options);
            if ($response->successful()){
                $responseBody = json_decode($response->body());
                foreach($responseBody->data as $data){
                    Tag::upsert([
                        'tag_id'=>$data->tag_id,
                        'localization_names'=>json_encode($data->localization_names),
                        'localization_descriptions'=>json_encode($data->localization_descriptions)
                    ], ['tag_id']);
                }
                if (isset($responseBody->pagination) && isset($responseBody->pagination->cursor))
                    $cursor = $responseBody->pagination->cursor;
                else
                    $hasNextPage = false;
            }else{
                $hasNextPage = false;
            }
        }
    }
}
