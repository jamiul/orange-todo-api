<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getTasksOfATodoList($todoList): object
    {
        return $todoList->tasks;
    }
    public function createTask(array $task, $todoList): object
    {
        return $todoList->tasks()->create($task);
    }
    public function updateTask(array $newtask, $task): object
    {
        $task->update($newtask);
        return $task;
    }
    public function deleteTask($task): bool
    {
        return $task->delete();
    }
}
