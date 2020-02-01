<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\CityContract;
use App\Contracts\InstitutionContract;
use App\Contracts\LevelContract;
use App\Contracts\InstitutionTypeContract;
use App\Contracts\ProgramTypeContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\LevelRepository;
use App\Repositories\InstitutionTypeRepository;
use App\Repositories\ProgramTypeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class => CategoryRepository::class,
        CityContract::class => CityRepository::class,
        LevelContract::class => LevelRepository::class,
        InstitutionTypeContract::class => InstitutionTypeRepository::class,
        InstitutionContract::class => InstitutionRepository::class,
        ProgramTypeContract::class => ProgramTypeRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
