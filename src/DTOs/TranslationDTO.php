<?php

declare(strict_types=1);

namespace Worksome\Translator\DTOs;

class TranslationDTO
{
    public function __construct(private string $source, private string $input, private string $text)
    {
    }

    public function getSourceLanguageCode(): string
    {
        return $this->source;
    }

    public function getInputText(): string
    {
        return $this->input;
    }

    public function getTranslatedText(): string
    {
        return $this->text;
    }
}
