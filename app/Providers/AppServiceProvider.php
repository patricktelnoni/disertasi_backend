<?php

namespace App\Providers;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;

use Illuminate\Support\ServiceProvider;
use App\Services\PostServiceInterface;
use App\Services\PostService;
use App\Services\ProductServiceInterface;
use App\Services\ProductService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }

        // Bind service interfaces to implementations
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

    }
}
