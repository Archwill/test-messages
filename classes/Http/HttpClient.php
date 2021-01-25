<?php


namespace Classes\Http;


class HttpClient implements HttpClientInterface
{
    private $curl;

    private function init()
    {
        $this->curl = curl_init();
    }

    private function closeConnection()
    {
        curl_close($this->curl);
    }

    public function get($url, $data): string
    {
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url . "?" . http_build_query($data));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        $this->closeConnection();
        return $result;
    }

    public function post($url, $data): string
    {
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        $this->closeConnection();
        return $result;
    }

    public function put($url, $data): string
    {
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_PUT, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        $this->closeConnection();
        return $result;
    }
}
