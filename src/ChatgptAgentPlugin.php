<?php
 
namespace LikeABas\FilamentChatgptAgent;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Facades\Blade;
 
class ChatgptAgentPlugin implements Plugin
{
    protected string $model;
    protected string $systemMessage;
    protected array $functions;

    public function getId(): string
    {
        return 'chatgpt-agent';
    }
 
    public function register(Panel $panel): void
    {
        $panel
            ->renderHook(
                'panels::body.end',
                fn (): string => auth()->check() ? Blade::render('@livewire(\'filament-chatgpt-agent\')'):'',
            );
    }
 
    public function boot(Panel $panel): void
    {
        //
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
}
