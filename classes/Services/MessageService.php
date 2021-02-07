<?php

namespace Classes\Services;

use Classes\Config;
use Classes\Http\HttpClientInterface;
use Classes\Comment\Comment;

class MessageService implements MessageServiceInterface
{
    private $httpClient;
    private $config;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
        $this->config = new Config();
    }

    private function validateComment(Comment $comment)
    {
        foreach (get_object_vars($comment) as $field => $value) {
            if ($field != "id" && empty($value)) {
                throw new \Exception("Поле {$field} должно быть заполнено");
            }
        }
    }

    public function getById($id): string
    {
        $url = $this->config->getUrl("getById", $id);
        return $this->httpClient->get($url, []);
    }

    public function getAll(): string
    {
        $url = $this->config->getUrl("getAll");
        return $this->httpClient->get($url, []);
    }

    public function save(Comment $comment): string
    {
        $this->validateComment($comment);

        $data = [
            "name" => $comment->name,
            "text" => $comment->text
        ];
        if (!is_null($comment->id) && $comment->id > 0) {
            $url = $this->config->getUrl("update", $comment->id);
            $result = $this->httpClient->put($url, $data);
        } else {
            $url = $this->config->getUrl("add");
            $result = $this->httpClient->post($url, $data);
        }

        return $result;
    }
}
