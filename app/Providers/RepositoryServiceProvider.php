<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\CityContract;
use App\Contracts\LevelContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\LevelRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        CityContract::class             =>          CityRepository::class,
        LevelContract::class             =>          LevelRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}