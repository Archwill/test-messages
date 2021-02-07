<?php

namespace Classes\Services;

interface MessageServiceInterface
{
    public function getById($id);
    
    public function getAll();
    
    public function save(Comment $comment);
}
