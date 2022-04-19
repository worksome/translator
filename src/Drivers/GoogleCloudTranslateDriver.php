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

    public function __construct(?string $projectId, ?string $key)
    {
        $this->client = new TranslateClient([
            'projectId' => $projectId,
            'key' => $key,
        ]);
    }

    public function translate(string $string, string $fromLanguage, string $toLanguage): ?TranslationDTO
    {
        return ($response = $this->client->translate($string, [
            'source' => $fromLanguage,
            'target' => $toLanguage,
            'format' => 'text'
        ]))
            ? new TranslationDTO(
                source: $response['source'],
                input: $response['input'],
                text: $response['text']
            )
            : null;
    }

    public function detectLanguage(string $string): ?DetectedLanguageDTO
    {
        return ($response = $this->client->detectLanguage($string))
            ? new DetectedLanguageDTO(
                languageCode: $response['languageCode'],
                confidence: $response['confidence']
            )
            : null;
    }
}
