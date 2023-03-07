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
    public function updateTask(array $newtask, $task): bool
    {
        return $task->update($newtask);
    }
    public function deleteTask($task): bool
    {
        return $task->delete();
    }
}
