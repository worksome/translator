<?php

declare(strict_types=1);

namespace Worksome\Translator;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Contracts\Translator;

class TranslatorServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('translator')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->app->singleton(Factory::class, TranslationManager::class);

        $this->app->bind(
            Translator::class,
            fn (Application $app) => (new TranslationManager($app))->driver()
        );
    }

    public function provides(): array
    {
        return [Factory::class, Translator::class];
    }
}
