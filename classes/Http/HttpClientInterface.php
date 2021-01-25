<?php


namespace Classes\Http;


interface HttpClientInterface
{
    public function get($url, $data);

    public function post($url, $data);

    public function put($url, $data);
}