<?php

declare(strict_types=1);

namespace Worksome\Translator;

use Exception;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Manager;
use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Drivers\GoogleCloudTranslateDriver;
use Worksome\Translator\Drivers\NullDriver;

class TranslationManager extends Manager implements Factory
{
    /**
     * Create a Google Cloud Translate engine instance.
     *
     * @return GoogleCloudTranslateDriver
     */
    public function createGoogleCloudTranslateDriver(): GoogleCloudTranslateDriver
    {
        $this->ensureGoogleCloudTranslateClientIsInstalled();

        return new GoogleCloudTranslateDriver(
            $this->config->get('translator.google_cloud_translate.project_id'),
            $this->config->get('translator.google_cloud_translate.key')
        );
    }

    /**
     * Ensure the Algolia API client is installed.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function ensureGoogleCloudTranslateClientIsInstalled()
    {
        if (class_exists(TranslateClient::class)) {
            return;
        }

        throw new Exception('Please install the Google Cloud Translate client: google/cloud-translate.');
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
