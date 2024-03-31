<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\Impl\CategoryRepositoryImpl;
use App\Repository\Impl\UserRepositoryImpl;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryRepository::class => CategoryRepositoryImpl::class,
        UserRepository::class => UserRepositoryImpl::class
    ];

    public function provides(): array
    {
        return [
            CategoryRepository::class,
            UserRepository::class
        ];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
