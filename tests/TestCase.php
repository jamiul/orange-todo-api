<?php

namespace Tests;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createTodo($args = [])
    {
        $todo = TodoList::factory()->create([
            'name' => $args['name'] ?? 'My Todo'
        ]);

        return $todo;
    }
}
