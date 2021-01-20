<?php

namespace Tests;

include "../vendor/autoload.php";

use Classes\Comment\Comment;
use Classes\MessageRepository;
use PHPUnit\Framework\TestCase;

class MessageRepositoryTest extends TestCase
{
    public function testAdd()
    {
        $repository = new MessageRepository();
        $comment = new Comment();
        $comment->name = "Testing";
        $comment->text = "Testing text";
        $savedComment = $repository->save($comment);
        $this->assertIsInt($savedComment->id);
        $this->assertInstanceOf(Comment::class, $savedComment, "Типы объектов не совпадают");
        $this->assertSame($comment->name, $savedComment->name, "Поля name объектов не совпадают");
        $this->assertSame($comment->text, $savedComment->text, "Поля text объектов не совпадают");
    }

    public function testUpdate()
    {
        $repository = new MessageRepository();
        $comment = new Comment();
        $comment->name = "Testing";
        $comment->text = "Testing text";
        $savedComment = $repository->save($comment);
        $this->assertIsInt($savedComment->id);
        $savedComment->name = "Updated name";
        $savedComment->text = "Updated text";
        $updatedComment = $repository->save($savedComment);
        $this->assertInstanceOf(Comment::class, $updatedComment, "Типы объектов не совпадают");
        $this->assertSame($savedComment->name, $updatedComment->name, "Поля name объектов не совпадают");
        $this->assertSame($savedComment->text, $updatedComment->text, "Поля text объектов не совпадают");
    }

    public function testGetAll()
    {
        $repository = new MessageRepository();
        $messages = $repository->getAll();
        $this->assertContainsOnly(Comment::class, $messages, false, "Возвращенные типы объектов не соответствуют классу Comment");;
    }

    public function testNameValidation(){
        $repository = new MessageRepository();
        $comment = new Comment();
        $comment->name = "";
        $comment->text = "Testing text";
        $this->expectException(\Exception::class);
        $savedComment = $repository->save($comment);
    }

    public function testTextValidation(){
        $repository = new MessageRepository();
        $comment = new Comment();
        $comment->name = "name";
        $comment->text = "";
        $this->expectException(\Exception::class);
        $savedComment = $repository->save($comment);
    }
}
