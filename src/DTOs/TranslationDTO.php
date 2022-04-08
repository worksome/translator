<?php

declare(strict_types=1);

namespace Worksome\Translator\DTOs;

class TranslationDTO
{
    public function __construct(private string $source, private string $input, private string $text)
    {
    }

    public static function fromArray(array $values): TranslationDTO
    {
        return new self(
            $values['source'],
            $values['input'],
            $values['text']
        );
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
