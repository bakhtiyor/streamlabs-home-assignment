<?php

namespace App\Repository\API;

use App;
use App\Models\Stream;
use App\Models\Tag;
use App\Models\User;
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

class TwitchRepository implements TwitchRepositoryInterface
{
    private $parameters;

    public function init($params)
    {
        $this->parameters = $params;
    }

    private function getHeaders(){
        return [
                    'Authorization' => "Bearer ".$this->parameters['token'],
                    'Client-Id' => $this->parameters['client_id']
                ];
    }

    private function getTagURL()
    {
        return $this->parameters['twitch_url'].'tags/streams';
    }

    private function getStreamURL()
    {
        return $this->parameters['twitch_url'].'streams';
    }

    private function getRefreshTokenURL()
    {
        return $this->parameters['twitch_token_refresh_url'];
    }

    private function getHandler()
    {
        $handler = HandlerStack::create();
        $logChannel = app()->get('log')->channel('daily');
        $handler->push(
            Middleware::log(
                $logChannel,
                new MessageFormatter('{uri} - {req_body} - {res_body}')
            )
        );
        return $handler;
    }

    public function fetchListOfTags()
    {
        $hasNextPage = true; $cursor = null; $options = ['first'=>100];
        while($hasNextPage){
            if (!is_null($cursor)) $options['after'] = $cursor;
            $Http = Http::withHeaders($this->getHeaders())->acceptJson();
            if (App::environment('local')){
                $Http->setHandler($this->getHandler());
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
            }else if($response->status()==401){
                //Unauthorized
                if ($this->refreshToken())
                    $this->fetchListOfTags();
                else
                    $hasNextPage = false;
            } else{
                $hasNextPage = false;
            }
        }
    }

    private function refreshToken(){
        $Http = Http::withHeaders($this->getHeaders())->acceptJson();
        if (App::environment('local')) {
            $Http->setHandler($this->getHandler());
        }
        $postData = [
            'grant_type'=>'refresh_token',
            'refresh_token' => $this->parameters['refresh_token'],
            'client_id' => $this->parameters['client_id'],
            'client_secret' => $this->parameters['client_secret'],
        ];
        $response = $Http->post($this->getRefreshTokenURL(), $postData);

        if ($response->successful()) {
            $responseBody = json_decode($response->body());
            User::where('twitch_id', $this->parameters['twitch_id'])->update([
                'twitch_token' => $responseBody->access_token,
                'twitch_refresh_token' => $responseBody->refresh_token,
            ]);
            $this->parameters['token'] = $responseBody->access_token;
            return true;
        }else{
            return false;
        }
    }

    public function fetchTopStreams()
    {
        $hasNextPage = true; $cursor = null; $options = ['first'=>100]; $iterations=0;
        while($hasNextPage) {
            $iterations ++;
            if (!is_null($cursor)) $options['after'] = $cursor;
            $Http = Http::withHeaders($this->getHeaders())->acceptJson();
            if (App::environment('local')) {
                $Http->setHandler($this->getHandler());
            }
            $response = $Http->get($this->getStreamURL(), $options);
            if ($response->successful()) {
                $responseBody = json_decode($response->body());
                foreach ($responseBody->data as $data) {
                    $Steam = Stream::find($data->id);
                    if (!isset($Steam->id)) {
                        $Stream = Stream::create([
                            'id' => $data->id,
                            'user_id' => $data->user_id,
                            'user_login' => $data->user_login,
                            'user_name' => $data->user_name,
                            'game_id' => (!empty($data->game_id)) ? $data->game_id : null,
                            'game_name' => $data->game_name,
                            'type' => $data->type,
                            'title' => $data->title,
                            'viewer_count' => $data->viewer_count,
                            'started_at' => Carbon::parse($data->started_at)->format('Y-m-d H:i:s'),
                            'language' => $data->language,
                            'thumbnail_url' => $data->thumbnail_url,
                            'is_mature' => $data->is_mature,
                        ]);
                        $tags = (isset($data->tag_ids)) ? $data->tag_ids : array();
                        foreach ($tags as $tag) {
                            $Stream->tags()->create(['stream_id' => $Stream->id, 'tag_id' => $tag]);
                        }
                    }
                }
                if (isset($responseBody->pagination) && isset($responseBody->pagination->cursor) && $iterations<=10)
                    $cursor = $responseBody->pagination->cursor;
                else if ($iterations>=10)
                    $hasNextPage = false;
                else
                    $hasNextPage = false;
            } else if($response->status()==401){
                //Unauthorized
                if ($this->refreshToken())
                    $this->fetchTopStreams();
                else
                    $hasNextPage = false;
            } else {
                $hasNextPage = false;
            }
        }
    }
}
