<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $todo;

    public function setUp(): void
    {
        parent::setUp();
        $this->todo = $this->createTodo();
    }

    public function test_fetch_todo_list()
    {
        $response = $this->getJson(route('todo-list.index'));

        $this->assertEquals('My Todo', $response->json()[0]['name']);
    }
}
