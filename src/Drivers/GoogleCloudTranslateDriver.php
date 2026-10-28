<?php

declare(strict_types=1);

namespace Worksome\Translator\Drivers;

use Google\Cloud\Translate\V3\Client\TranslationServiceClient;
use Google\Cloud\Translate\V3\DetectLanguageRequest;
use Google\Cloud\Translate\V3\TranslateTextRequest;
use InvalidArgumentException;
use Worksome\Translator\Contracts\Translator;
use Worksome\Translator\DTOs\DetectedLanguageDTO;
use Worksome\Translator\DTOs\TranslationDTO;

class GoogleCloudTranslateDriver implements Translator
{
    protected TranslationServiceClient $client;

    protected string $parent;

    public function __construct(string|null $projectId, string|null $key)
    {
        if ($projectId === null || $projectId === '') {
            throw new InvalidArgumentException(
                'A Google Cloud project ID is required to use the Google Cloud Translate driver.'
            );
        }

        $this->client = new TranslationServiceClient([
            'apiKey' => $key,
        ]);

        $this->parent = TranslationServiceClient::locationName($projectId, 'global');
    }

    public function translate(string $string, string $fromLanguage, string $toLanguage): TranslationDTO|null
    {
        $response = $this->client->translateText(
            (new TranslateTextRequest())
                ->setParent($this->parent)
                ->setContents([$string])
                ->setSourceLanguageCode($fromLanguage)
                ->setTargetLanguageCode($toLanguage)
                ->setMimeType('text/plain')
        );

        /** @var \Google\Cloud\Translate\V3\Translation|null $translation */
        $translation = $response->getTranslations()[0] ?? null;

        return $translation
            ? new TranslationDTO(
                source: $fromLanguage,
                input: $string,
                text: $translation->getTranslatedText()
            )
            : null;
    }

    public function detectLanguage(string $string): DetectedLanguageDTO|null
    {
        $response = $this->client->detectLanguage(
            (new DetectLanguageRequest())
                ->setParent($this->parent)
                ->setContent($string)
                ->setMimeType('text/plain')
        );

        /** @var \Google\Cloud\Translate\V3\DetectedLanguage|null $language */
        $language = $response->getLanguages()[0] ?? null;

        return $language
            ? new DetectedLanguageDTO(
                languageCode: $language->getLanguageCode(),
                confidence: $language->getConfidence()
            )
            : null;
    }
}
