<?php

namespace App\Repository;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;

class Twitch
{
    private $apiUrl;
    private $headers = [];

    public function init($url, $headers)
    {
        $this->apiUrl = $url;
        $this->headers =$headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getTagURL()
    {
        return $this->apiUrl.'tags/streams';
    }
}
