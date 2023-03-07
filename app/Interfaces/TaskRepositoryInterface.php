<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function getTasksOfATodoList($todoList);
    public function createTask(array $task, $todoList);
    public function updateTask(array $newtask, $taskId);
    public function deleteTask($taskId);
}
