<?php


namespace Classes\Http;


class HttpClient implements HttpClientInterface
{
    private $curl;

    private function executeQuery($curlOptions): string
    {
        $this->curl = curl_init();
        foreach ($curlOptions as $key => $value) {
            curl_setopt($this->curl, $key, $value);
        }
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->curl);
        $this->closeConnection();
        return $result;
    }

    public function get($url, $data): string
    {
        $options = [
            CURLOPT_URL => $url . "?" . http_build_query($data),
        ];
        return $this->executeQuery($options);
    }

    public function post($url, $data): string
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
        ];
        return $this->executeQuery($options);
    }

    public function put($url, $data): string
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_PUT => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
        ];
        return $this->executeQuery($options);
    }
}
