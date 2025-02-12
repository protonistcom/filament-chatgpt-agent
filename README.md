# ChatGPT Agent for Filament

Filament ChatGPT Agent is a filament plugin that allow you to easily integrate ChatGPT in your Filament project, and allowing ChatGPT to access context information from your project by creating GPT functions.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/icetalker/filament-chatgpt-bot.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-chatgpt-bot)
[![Total Downloads](https://img.shields.io/packagist/dt/icetalker/filament-chatgpt-bot.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-chatgpt-bot)

## Installation

You need to have [Laravel GPT from Malkuhr](https://github.com/maltekuhr/laravel-gpt) installed to use this package. If you haven't done so, do so by following the [installation instructions](https://github.com/maltekuhr/laravel-gpt?tab=readme-ov-file#installation):

You can install the package via composer:

```bash
composer require maltekuhr/laravel-gpt
```

Next you need to configure your OpenAI API Key and Organization ID. You can find both in the [OpenAI Dashboard](https://platform.openai.com/account/org-settings).

```dotenv
OPENAI_ORGANIZATION=YOUR_ORGANIZATION_ID
OPENAI_API_KEY=YOUR_API_KEY
```

Now you can install this package via composer:

```bash
composer require likeabas/filament-chatgpt-agent
```

## Views

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-chatgpt-agent-views"
```

## Translations

Optionally, you can publish translations using

```bash
php artisan vendor:publish --tag="filament-chatgpt-agent-translations"
```

## Usage

1. You need to add the plugin to your Filament [Panel Configuration](https://laravel-filament.cn/docs/en/3.x/panels/configuration).

```php

    public function panel(Panel $panel): Panel
    {
        return $panel
            ...
            ->plugin(
                ChatgptAgentPlugin::make()
            )
            ...
    }
```

2. You can also set some options if you like:

```php

use App\GPT\Functions\YourCustomGPTFunction;

...

    public function panel(Panel $panel): Panel
    {
        return $panel
            ...
            ->plugin(
                ChatgptAgentPlugin::make()
                    ->defaultPanelWidth('400px') // default 350px
                    ->botName('GPT Assistant')
                    ->model('gpt-4o')
                    ->buttonText('Ask ChatGPT')
                    ->buttonIcon('heroicon-m-sparkles')
                    ->systemMessage('Act nice and help') // System instructions for the GPT
                    ->functions([ // Array of GPTFunctions the GPT can use
                        new YourCustomGPTFunction(),
                    ])
                    ->startMessage('Hello sir! How can I help you today?') // Default start message, set to false to not show a message
            )
            ...
    }
```

> Other language strings can be altered in the translations file. Just [publish the translations](#translations).

4. You can add it to any blade file if you like:

```blade
<body>

    ...

    @livewire('filament-chatgpt-agent')
</body>
```

> This is work for all livewire page in any Laravel Project, not just Filament. Please also make sure Tailwind CSS, Filament and Livewire were imported properly while use in other Laravel Project.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- Package created by [Bas Schleijpen](https://github.com/likeabas).
- The view and livewire component structure was inspired by [Martin Hwang](https://github.com/icetalker).
- [All Contributors](../../contributors)
