<?php

declare(strict_types=1);

use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Drivers\GoogleCloudTranslateDriver;
use Worksome\Translator\Drivers\NullDriver;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;
use Worksome\Translator\Facades\Translator;

it('can instantiate the Google Cloud Translate driver', function () {
    $factory = $this->app->make(Factory::class);

    $provider = $factory->driver('google_cloud_translate');

    expect($provider)->toBeInstanceOf(GoogleCloudTranslateDriver::class);
});

it('can translate using the null driver', function () {
    $this->app['config']->set('translator.driver', null);

    $factory = $this->app->make(Factory::class);

    $provider = $factory->driver();

    expect($provider)
        ->toBeInstanceOf(NullDriver::class)
        ->translate('This is being translated', 'en', 'en')
        ->toBeInstanceOf(TranslationDTO::class)
        ->toEqual(new TranslationDTO(source: 'en', input: 'This is being translated', text: 'This is being translated'));
});

it('can detect input language using the null driver', function () {
    $this->app['config']->set('translator.driver', null);

    $factory = $this->app->make(Factory::class);

    $provider = $factory->driver()->detectLanguage('This is being translated');

    expect($provider)
        ->toBeInstanceOf(DetectedLanguageDTO::class)
        ->toEqual(new DetectedLanguageDTO(languageCode: 'en', confidence: 1.0));
});

it('can use the Translator Facade', function () {
    $this->app['config']->set('translator.driver', null);

    $provider = Translator::translate('This is being translated', 'en', 'en');

    expect($provider)
        ->toBeInstanceOf(TranslationDTO::class)
        ->toEqual(new TranslationDTO(source: 'en', input: 'This is being translated', text: 'This is being translated'));
});
