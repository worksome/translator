<?php

declare(strict_types=1);

namespace Worksome\Translator;

use Illuminate\Contracts\Support\DeferrableProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Worksome\Translator\Contracts\Factory;

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
        $this->app->singleton(Factory::class, function ($app) {
            return new TranslationManager($app);
        });
    }

    public function provides(): array
    {
        return [Factory::class];
    }
}
