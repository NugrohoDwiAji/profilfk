<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\TranslatableStringSynth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        if (class_exists(Livewire::class)) {
            Livewire::propertySynthesizer(TranslatableStringSynth::class);
        }

        View::composer('*', function ($view): void {
            if (! $view->offsetExists('settings')) {
                $view->with('settings', SiteSetting::allMap());
            }
        });
    }
}
