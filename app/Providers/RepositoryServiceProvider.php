<?php

namespace App\Providers;

use App\Interfaces\CakeEmailRepositoryInterface;
use App\Interfaces\CakeRepositoryInterface;
use App\Repository\CakeEmailRepository;
use App\Repository\CakeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CakeRepositoryInterface::class, CakeRepository::class);
        $this->app->bind(CakeEmailRepositoryInterface::class, CakeEmailRepository::class);
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
