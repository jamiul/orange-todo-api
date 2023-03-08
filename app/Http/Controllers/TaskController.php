<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TodoList $todoList): JsonResponse
    {
        $todoListTasks = $this->taskRepository->getTasksOfATodoList($todoList);

        return response()
            ->json($todoListTasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request, TodoList $todoList)
    {
        $input = $request->all();
        $task = $this->taskRepository->createTask($input, $todoList);

        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->all();
        $task = $this->taskRepository
            ->updateTask($data, $task);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->taskRepository->deleteTask($task);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
