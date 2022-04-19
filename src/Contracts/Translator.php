<?php

declare(strict_types=1);

namespace Worksome\Translator\Contracts;

use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

interface Translator
{
    public function translate(string $string, string $fromLanguage, string $toLanguage): ?TranslationDTO;

    public function detectLanguage(string $string): ?DetectedLanguageDTO;
}
