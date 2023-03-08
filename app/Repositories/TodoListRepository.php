<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use App\Models\TodoList;

class TodoListRepository implements TodoListRepositoryInterface
{

    /**
     * only authenticate user can fetch his/her todo list
     */
    public function getAllTodoList()
    {
        $authUserTodoList = auth()->user()->todo_lists;
        return $authUserTodoList;
    }

    public function getTodoListById($todoListId)
    {
        return $todoListId;
    }

    /**
     * authenticate user can create new todo list
     */
    public function createTodoList(array $todoList)
    {
        return auth()->user()->todo_lists()->create($todoList);
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
