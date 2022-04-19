<?php

declare(strict_types=1);

namespace Worksome\Translator\Drivers;

use Worksome\Translator\Contracts\Translator;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

class NullDriver implements Translator
{
    public function translate(string $string, string $fromLanguage, string $toLanguage): TranslationDTO
    {
        return new TranslationDTO(
            source: $fromLanguage,
            input: $string,
            text: $string
        );
    }

    public function detectLanguage(string $string): DetectedLanguageDTO
    {
        return new DetectedLanguageDTO(
            languageCode: 'en',
            confidence: 1.0,
        );
    }
}
