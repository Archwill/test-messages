<?php

namespace Classes;

use Classes\Comment\Comment;
use Classes\Comment\CommentFactory;
use Classes\Http\HttpClient;
use Classes\Services\MessageService;
use Classes\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
{
    private function initService(): MessageService
    {
        $httpClient = new HttpClient();
        return new MessageService($httpClient);
    }

    public function getAll(): array
    {
        $comments = json_decode($this->initService()->getAll(), true);
        return array_map(array(CommentFactory::class, "createComment"), $comments);
    }

    public function getById($id): Comment
    {
        $comment = json_decode($this->initService()->getById($id), true);
        return CommentFactory::createComment($comment);
    }

    public function save(Comment $comment): Comment
    {
        $comment = json_decode($this->initService()->save($comment), true);
        return CommentFactory::createComment($comment);
    }
}