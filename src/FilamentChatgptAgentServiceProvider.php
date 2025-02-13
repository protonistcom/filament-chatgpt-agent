<?php

namespace LikeABas\FilamentChatgptAgent;

use LikeABas\FilamentChatgptAgent\Components\ChatgptAgent;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->name('chatgpt-agent')
            ->hasTranslations()
            ->hasViews();
    }

    /**
     * Bootstrap any application services.
     */
    public function packageBooted(): void
    {
        Livewire::component('fi-chatgpt-agent', ChatgptAgent::class);
    }

}
