<?php

declare(strict_types=1);

namespace Worksome\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use Worksome\Translator\Contracts\Factory;
use Worksome\Translator\Contracts\Translator as TranslatorContract;

/**
 * @see Factory
 *
 * @mixin TranslatorContract
 */
class Translator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
