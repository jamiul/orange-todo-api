<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->signIn();
    }

    public function test_an_authenticated_user_fetch_task_of_a_todo_list()
    {
        // create todo list
        $todo = $this->createTodo();
        // create task
        $task = $this->createTask(['todo_list_id' => $todo->id]);
        $this->createTask(['todo_list_id' => 2]);
        // fetch all task
        $response = $this->getJson(route('todo-list.task.index', $todo->id))->assertOk()->json();

        // then perform an action
        $this->assertEquals($task->title, $response[0]['title']);
        $this->assertEquals($response[0]['todo_list_id'], $todo->id);
    }

    public function test_an_authenticated_user_can_create_a_task_for_a_todo_list()
    {
        $todo = $this->createTodo();
        $task = Task::factory()->make();

        $this->postJson(route('todo-list.task.store', $todo->id), [
            'title' => $task->title,
            'todo_list_id' => $todo->id
        ])->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
            'todo_list_id' => $todo->id
        ]);
    }

    public function test_an_authenticated_user_can_update_task()
    {
        $task = $this->createTask();
        $updateTask = [
            'title' => 'Task updated',
            'todo_list_id' => $task->todo_list_id
        ];

        $this->patchJson(route('task.update', $task->id), $updateTask)->assertOk();

        $this->assertDatabaseHas('tasks', ['title' => 'Task updated']);
    }

    public function test_an_authenticated_user_can_delete_task()
    {
        $task = $this->createTask();

        $this->deleteJson(route('task.destroy', $task->id))->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
