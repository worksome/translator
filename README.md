# Translator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/translator.svg?style=flat-square&label=Packagist)](https://packagist.org/packages/worksome/translator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/worksome/translator/Tests?label=Tests&style=flat-square)](https://github.com/owenvoke/translator/actions?query=workflow%3ATests)
[![GitHub PHPStan Action Status](https://img.shields.io/github/workflow/status/worksome/translator/PHPStan?label=PHPStan&style=flat-square)](https://github.com/owenvoke/translator/actions?query=workflow%3APHPStan)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/translator.svg?style=flat-square&label=Downloads)](https://packagist.org/packages/worksome/translator)

A driver-based translation package for Laravel.

## Installation

You can install the package via composer:

```bash
composer require worksome/translator
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translator-config"
```

## Usage

```php
$translator = new Worksome\Translator\TranslationManager();

$translator->driver('google_cloud_translate')->translate('Text to translate', 'en', 'da'); // TranslationDTO
$translator->driver('google_cloud_translate')->detectLanguage('Text to detect'); // DetectedLanguageDTO

// Via the Facade
use Worksome\Translator\Facades\Translator;

Translator::translate(''); // Use the default driver
Translator::driver('google_cloud_translate')->translate('', 'en', 'da'); // Use a custom driver
```

Test suites can utilise the [`null` driver](src/Drivers/NullDriver.php), this will always return the same string value as provided for translations.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Owen Voke](https://github.com/owenvoke)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
