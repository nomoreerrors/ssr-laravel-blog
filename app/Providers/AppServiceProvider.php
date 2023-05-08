<?php

namespace App\Providers;

use App\View\Components\MyTestComponent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade::component('lolwut', MyTestComponent::class);
        Blade::components([
                'lolwut' => MyTestComponent::class,
                
        ]);
    }
}
