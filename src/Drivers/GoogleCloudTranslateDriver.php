<?php

declare(strict_types=1);

namespace Worksome\Translator\Drivers;

use Google\Cloud\Translate\V2\TranslateClient;
use Worksome\Translator\Contracts\Translator;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

class GoogleCloudTranslateDriver implements Translator
{
    protected TranslateClient $client;

    public function __construct(string|null $projectId, string|null $key)
    {
        $this->client = new TranslateClient([
            'projectId' => $projectId,
            'key' => $key,
        ]);
    }

    public function translate(string $string, string $fromLanguage, string $toLanguage): TranslationDTO|null
    {
        /** @var array{source: string, input: string, text: string}|null $response */
        $response = $this->client->translate($string, [
            'source' => $fromLanguage,
            'target' => $toLanguage,
            'format' => 'text',
        ]);

        return $response
            ? new TranslationDTO(
                source: $response['source'],
                input: $response['input'],
                text: $response['text']
            )
            : null;
    }

    public function detectLanguage(string $string): DetectedLanguageDTO|null
    {
        /** @var array{languageCode: string, confidence: float}|null $response */
        $response = $this->client->detectLanguage($string);

        return $response
            ? new DetectedLanguageDTO(
                languageCode: $response['languageCode'],
                confidence: $response['confidence']
            )
            : null;
    }
}
