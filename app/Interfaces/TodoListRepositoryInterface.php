<?php

namespace App\Interfaces;

interface TodoListRepositoryInterface
{
    public function getAllTodoList();
    public function getTodoListById($todoListId);
    public function createTodoList(array $todoList);
    public function updateTodoList($todoListId, array $newTodoList);
    public function deleteTodoList($todoListId);
}
