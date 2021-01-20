<?php


namespace Classes\Http;


class HttpClient
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function get($url, $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url . "?" . http_build_query($data));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return $result;
    }

    public function post($url, $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return $result;
    }

    public function put($url, $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_PUT, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return $result;
    }
}
