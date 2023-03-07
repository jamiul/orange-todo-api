<?php

namespace App\Providers;

use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TodoListRepository;
use App\Interfaces\TodoListRepositoryInterface;
use App\Repositories\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
