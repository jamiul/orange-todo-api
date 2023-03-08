<?php

namespace Tests;

use App\Models\Task;
use App\Models\User;
use App\Models\TodoList;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: $this->createUser();
        Sanctum::actingAs($user);

        return $user;
    }

    // create a new todo list
    public function createTodo($override = [])
    {
        return create(TodoList::class, $override);
    }

    // create a new task associated with todo list
    public function createTask($override = [])
    {
        return create(Task::class, $override);
    }

    // register a new user
    public function createUser($override = [])
    {
        return create(User::class, $override);
    }
}
