<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_user_can_fetch_todo_list()
    {
        $response = $this->getJson(
            route('todo-list.index')
        )->json();

        $this->assertEquals(
            $this->todo->name,
            $response[0]['name']
        );
    }

    public function test_user_can_fetch_single_todo_list()
    {
        $response = $this->getJson(
            route('todo-list.show', $this->todo->id)
        )
            ->assertOk()
            ->json();

        $this->assertEquals(
            $response['name'],
            $this->todo->name
        );
    }

    public function test_user_can_store_new_todo()
    {
        $todo = TodoList::factory()->make();

        $response = $this->postJson(
            route('todo-list.store'),
            ['name' => $todo->name]
        );

        $this->assertEquals(
            $todo->name,
            $response['name']
        );
    }

    public function test_a_todo_list_requires_a_name()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('name');
    }

    public function test_user_may_delete_todo()
    {
        $this->deleteJson(route('todo-list.destroy', $this->todo->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->todo->name]);
    }

    public function test_user_can_update_todo()
    {
        $this->patchJson(route('todo-list.update', $this->todo->id), ['name' => 'My updated todo list'])
            ->assertOk();

        $this->assertDatabaseHas('todo_lists', [
            'id' => $this->todo->id,
            'name' => 'My updated todo list'
        ]);
    }

    public function test_todo_name_field_is_required_while_updating()
    {
        $this->withExceptionHandling();

        $this->patchJson(route('todo-list.update', $this->todo->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
}
