<?php

declare(strict_types=1);

namespace Worksome\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Contracts\TranslationDriver;

/**
 * @see Factory
 * @mixin TranslationDriver
 */
class Translator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
