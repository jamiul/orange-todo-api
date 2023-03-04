<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTodoListRequest;
use App\Http\Requests\UpdateTodoListRequest;
use App\Interfaces\TodoListRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;


class TodoListController extends Controller
{
    private TodoListRepositoryInterface $todoListRepository;

    public function __construct(TodoListRepositoryInterface $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $todos = $this->todoListRepository->getAllTodoList();
        return response()->json($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoListRequest $request)
    {
        $input = $request->all();
        $todo = $this->todoListRepository->createTodoList($input);

        return $todo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        $todo = $this->todoListRepository->getTodoListById($todoList);
        return response($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoListRequest  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoListRequest $request, TodoList $todoList)
    {
        $todoList = $this->todoListRepository->updateTodoList($todoList, $request->all());

        return response($todoList);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todoList): Response
    {
        $todoList = $this->todoListRepository->deleteTodoList($todoList);
        return response('', Response::HTTP_NO_CONTENT);
    }
}
