<?php

declare(strict_types=1);

namespace Worksome\Translator\Contracts;

interface Factory
{
    /**
     * Get a Translation driver implementation.
     *
     * @param  string  $driver
     * @return TranslationDriver
     */
    public function driver($driver = null);
}
