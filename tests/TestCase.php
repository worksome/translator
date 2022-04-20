<?php

declare(strict_types=1);

namespace Worksome\Translator\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Worksome\Translator\TranslatorServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            TranslatorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('translator.driver', null);

        config()->set('translator.google_cloud_translate', [
            'project_id' => 'abcdefg',
            'key' => 'abcdefg',
        ]);
    }
}
