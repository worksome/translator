<?php

declare(strict_types=1);

namespace Worksome\Translator\DTOs;

class DetectedLanguageDTO
{
    public function __construct(private string $languageCode, private float $confidence)
    {
    }

    public static function fromArray(array $values): DetectedLanguageDTO
    {
        return new self(
            languageCode: $values['languageCode'],
            confidence: $values['confidence']
        );
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function getConfidence(): float
    {
        return $this->confidence;
    }
}
