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
        return TodoList::findOrFail($todoListId);
    }

    public function createTodoList(array $todoList)
    {
        return TodoList::create($todoList);
    }
    public function updateTodoList($todoListId, array $newTodoList)
    {
        return TodoList::whereId($todoListId)->update($newTodoList);
    }
    public function deleteTodoList($todoListId)
    {
        return TodoList::destroy($todoListId);
    }
}
