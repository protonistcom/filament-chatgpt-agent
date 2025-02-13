<?php

namespace LikeABas\FilamentChatgptAgent;

use Filament\Contracts\Plugin;
use Filament\Panel;

class ChatgptAgentPlugin implements Plugin
{
    protected string $botName;
    protected string $buttonText;
    protected string $buttonIcon = 'heroicon-m-sparkles';
    protected string $sendingText;
    protected string $model = 'gpt-4o';
    protected string $systemMessage = '';
    protected array $functions = [];
    protected string $defaultPanelWidth = '350px';
    protected string|bool $startMessage = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'chatgpt-agent';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->renderHook(
                'panels::body.end',
                fn () => auth()->check() ? view('chatgpt-agent::components.filament-chatgpt-agent') : '',
            );
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function botName(string $name): static
    {
        $this->botName = $name;

        return $this;
    }

    public function getBotName(): string
    {
        return $this->botName ?? __('chatgpt-agent::translations.bot_name');
    }

    public function buttonText(string $text): static
    {
        $this->buttonText = $text;

        return $this;
    }

    public function getButtonText(): string
    {
        return $this->buttonText ?? __('chatgpt-agent::translations.button_text');
    }

    public function buttonIcon(string $icon): static
    {
        $this->buttonIcon = $icon;

        return $this;
    }

    public function getButtonIcon(): string
    {
        return $this->buttonIcon;
    }

    public function sendingText(string $text): static
    {
        $this->sendingText = $text;

        return $this;
    }

    public function getSendingText(): string
    {
        return $this->sendingText ??__('chatgpt-agent::translations.sending_text');
    }

    public function model(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function systemMessage(string $message): static
    {
        $this->systemMessage = $message;

        return $this;
    }

    public function getSystemMessage(): string
    {
        return $this->systemMessage;
    }

    public function functions(array $functions): static
    {
        $this->functions = $functions;

        return $this;
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }

    public function defaultPanelWidth(string $width): static
    {
        $this->defaultPanelWidth = $width;

        return $this;
    }

    public function getDefaultPanelWidth(): string
    {
        return $this->defaultPanelWidth;
    }

    public function startMessage(string|bool $message): static
    {
        $this->startMessage = ($message === false || $message === '') ? false : $message;

        return $this;
    }

    public function getStartMessage(): string
    {
        return $this->startMessage;
    }
}