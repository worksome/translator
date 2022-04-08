<?php

declare(strict_types=1);

namespace Worksome\Translator\Drivers;

use Worksome\Translator\Contracts\TranslationDriver;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

class NullDriver implements TranslationDriver
{
    /** {@inheritdoc} */
    public function translate(string $string, array $options = []): TranslationDTO
    {
        return new TranslationDTO(
            source: 'en',
            input: $string,
            text: $string
        );
    }

    /** {@inheritdoc} */
    public function detectLanguage(string $string, array $options = []): DetectedLanguageDTO
    {
        return new DetectedLanguageDTO(
            languageCode: $options['source'] ?? 'en',
            confidence: 1.0,
        );
    }
}
