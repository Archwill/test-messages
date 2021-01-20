<?php


namespace Classes;


use Classes\Comment\Comment;
use Classes\Comment\CommentFactory;
use Classes\Http\HttpClient;
use Classes\Services\MessageService;
use Interfaces\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
{
    public function getAll()
    {
        $httpClient = new HttpClient();
        $messageService = new MessageService($httpClient);
        $comments = json_decode($messageService->getAll(), true);
        return array_map(array(CommentFactory::class, "createComment"), $comments);
    }

    public function getById($id)
    {
        $comments = $this->getAll();
        foreach ($comments as $comment){
            if($comment->id == $id){
                return $comment;
            }
        }
        return false;
    }

    public function save(Comment $comment)
    {
        $httpClient = new HttpClient();
        $messageService = new MessageService($httpClient);
        return CommentFactory::createComment($messageService->save($comment));
    }
}