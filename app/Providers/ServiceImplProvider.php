<?php

namespace App\Providers;

use App\Service\AuthService;
use App\Service\CategoryService;
use App\Service\Impl\AuthServiceImpl;
use App\Service\Impl\CategoryServiceImpl;
use Illuminate\Support\ServiceProvider;

class ServiceImplProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryService::class => CategoryServiceImpl::class,
        AuthService::class => AuthServiceImpl::class
    ];

    public function provides(): array
    {
        return [
            CategoryService::class,
            AuthService::class
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
