<?php

declare(strict_types=1);

namespace Worksome\Translator\Drivers;

use Google\Cloud\Translate\V2\TranslateClient;
use Worksome\Translator\Contracts\TranslationDriver;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

class GoogleCloudTranslateDriver implements TranslationDriver
{
    protected TranslateClient $client;

    public function __construct(?string $projectId, ?string $key)
    {
        $this->client = new TranslateClient([
            'projectId' => $projectId,
            'key' => $key,
        ]);
    }

    /** {@inheritdoc} */
    public function translate(string $string, array $options = []): ?TranslationDTO
    {
        return ($response = $this->client->translate($string, $options))
            ? TranslationDTO::fromArray($response)
            : null;
    }

    /** {@inheritdoc} */
    public function detectLanguage(string $string, array $options = []): ?DetectedLanguageDTO
    {
        return ($response = $this->client->detectLanguage($string, $options))
            ? DetectedLanguageDTO::fromArray($response)
            : null;
    }
}
