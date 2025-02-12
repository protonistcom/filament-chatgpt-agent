<?php

namespace LikeABas\FilamentChatgptAgent;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use LikeABas\FilamentChatgptAgent\Components\ChatgptAgent;
use Livewire\Livewire;

class FilamentChatgptAgentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-chatgpt-agent')
            ->hasTranslations()
            ->hasViews();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootLoaders();
        $this->bootPublishing();

        Livewire::component('filament-chatgpt-agent', ChatgptAgent::class);
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-chatgpt-agent');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-chatgt-agent');
    }

    protected function bootPublishing()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-chatgpt-agent'),
        ], 'filament-chatgpt-agent-views');
    }

}
