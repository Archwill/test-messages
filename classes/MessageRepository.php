<?php

namespace Classes;

use Classes\Comment\Comment;
use Classes\Comment\CommentFactory;
use Classes\Http\HttpClient;
use Classes\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
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
        $comment = $this->httpClient->get($url, []);
        return CommentFactory::createComment($comment);
    }

    public function getAll(): string
    {
        $url = $this->config->getUrl("getAll");
        $comments = $this->httpClient->get($url, []);
        return array_map(array(CommentFactory::class, "createComment"), $comments);
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
            $comment = $this->httpClient->put($url, $data);
        } else {
            $url = $this->config->getUrl("add");
            $comment = $this->httpClient->post($url, $data);
        }
        
        return CommentFactory::createComment($comment);
    }
}
