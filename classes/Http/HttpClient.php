<?php


namespace Classes\Http;


class HttpClient
{
    private $curl;

    private $tempStorage = [];

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function get($url, $data)
    {
//        curl_setopt($this->curl, CURLOPT_URL, $url . "?" . http_build_query($data));
//        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($this->curl);
//        curl_close($this->curl);
        $result = json_encode($this->tempStorage);
        return $result;
    }

    public function post($url, $data)
    {
//        curl_setopt($this->curl, CURLOPT_URL, $url);
//        curl_setopt($this->curl, CURLOPT_POST, true);
//        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($this->curl);
//        curl_close($this->curl);
            $id = count($this->tempStorage);
            $this->tempStorage[$id]["id"] = $id;
            $this->tempStorage[$id]["text"] = $data["text"];
            $this->tempStorage[$id]["name"] = $data["name"];
            $result = $this->tempStorage[$id];
        return $result;
    }

    public function put($url, $data)
    {
//        curl_setopt($this->curl, CURLOPT_URL, $url);
//        curl_setopt($this->curl, CURLOPT_PUT, true);
//        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
//        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($this->curl);
//        curl_close($this->curl);
            $this->tempStorage[$data["ID"]]["text"] = $data["text"];
            $this->tempStorage[$data["ID"]]["name"] = $data["name"];
            $result = $this->tempStorage[$data["ID"]];

        return $result;
    }
}