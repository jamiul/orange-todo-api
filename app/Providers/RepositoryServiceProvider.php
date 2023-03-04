<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TodoListRepository;
use App\Interfaces\TodoListRepositoryInterface;

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
