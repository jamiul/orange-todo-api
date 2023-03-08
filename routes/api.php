<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TodoListController;

// public routes
Route::post('/register', [UserController::class, 'register'])
    ->name('user.register');
Route::post('/login', [LoginController::class, 'login'])
    ->name('user.login');

// protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todo-list', TodoListController::class);

    Route::apiResource('todo-list.task', TaskController::class)
        ->except('show')
        ->shallow();
});
