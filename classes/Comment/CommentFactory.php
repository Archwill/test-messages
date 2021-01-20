<?php


namespace Classes\Comment;


class CommentFactory
{
    public static function createComment($fields){
        $comment = new Comment();
        $comment->id = $fields["id"];
        $comment->name = $fields["name"];
        $comment->text = $fields["text"];
        return $comment;
    }
}