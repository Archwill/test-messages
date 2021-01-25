<?php


namespace Classes;

use Classes\Comment\Comment;

interface MessageRepositoryInterface
{
    public function getAll();
    public function save(Comment $element);
    public function getById($id);
}