<?php

declare(strict_types=1);

namespace Worksome\Translator;

use Illuminate\Support\Manager;
use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Contracts\Translator;
use Worksome\Translator\Drivers\GoogleCloudTranslateDriver;
use Worksome\Translator\Drivers\NullDriver;

/** @mixin Translator */
class TranslationManager extends Manager implements Factory
{
    public function createGoogleCloudTranslateDriver(): GoogleCloudTranslateDriver
    {
        return new GoogleCloudTranslateDriver(
            $this->config->get('translator.google_cloud_translate.project_id'),
            $this->config->get('translator.google_cloud_translate.key')
        );
    }

    public function createNullDriver(): NullDriver
    {
        return new NullDriver();
    }

    public function getDefaultDriver()
    {
        if (is_null($driver = config('translator.driver'))) {
            return 'null';
        }

        return $driver;
    }
}
