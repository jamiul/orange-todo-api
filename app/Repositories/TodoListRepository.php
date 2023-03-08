<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use App\Models\TodoList;

class TodoListRepository implements TodoListRepositoryInterface
{
    public function getAllTodoList()
    {
        return TodoList::all();
    }

    public function getTodoListById($todoListId)
    {
        return $todoListId;
    }

    public function createTodoList(array $todoList)
    {
        return TodoList::create($todoList);
    }
    public function updateTodoList($todoList, array $newTodoList): object
    {
        $todoList->update($newTodoList);
        return $todoList;
    }
    public function deleteTodoList($todoListId)
    {
        return $todoListId->delete();
    }
}
