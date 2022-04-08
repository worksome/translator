<?php

declare(strict_types=1);

namespace Worksome\Translator\Contracts;

use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

interface TranslationDriver
{
    /** @param array{source?: string, target?: string, format?: string, model?: string} $options */
    public function translate(string $string, array $options = []): ?TranslationDTO;

    /** @param array{source?: string, target?: string, format?: string, model?: string} $options */
    public function detectLanguage(string $string, array $options = []): ?DetectedLanguageDTO;
}
