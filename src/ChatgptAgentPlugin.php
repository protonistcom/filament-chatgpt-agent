<?php
 
namespace LikeABas\FilamentChatgptAgent;

use Filament\Contracts\Plugin;
use Filament\Panel;
 
class ChatgptAgentPlugin implements Plugin
{
    protected string $botName = 'ChatGPT Agent';
    protected string $buttonText = 'Ask ChatGPT';
    protected string $buttonIcon = 'heroicon-m-sparkles';
    protected string $sendingText = 'Sending...';
    protected string $model = 'gpt-4o';
    protected string $systemMessage = '';
    protected array $functions = [];
    protected string $defaultPanelWidth = '350px';

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
                fn () => auth()->check() ? view('filament-chatgpt-agent::components.filament-chatgpt-agent') : '',
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
        return $this->botName;
    }

    public function buttonText(string $text): static
    {
        $this->buttonText = $text;

        return $this;
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
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
        return $this->sendingText;
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
}
