<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\Impl\CategoryRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryRepository::class => CategoryRepositoryImpl::class,
    ];

    public function provides(): array
    {
        return [
            CategoryRepository::class
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
