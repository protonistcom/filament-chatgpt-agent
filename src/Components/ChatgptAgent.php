<?php

namespace LikeABas\FilamentChatgptAgent\Components;

use Livewire\Component;

class ChatgptAgent extends Component
{

    public string $name;

    public string $buttonText;

    public string $buttonIcon;

    public string $sendingText;

    public array $messages;

    public string $question;

    public string $winWidth;

    public string $winPosition;

    public bool $showPositionBtn;

    public bool $panelHidden;

    private string $sessionKey;

    public function __construct()
    {
        $this->sessionKey = auth()->id() . '-chatgpt-agent-messages';
    }

    public function mount(): void
    {
        $this->panelHidden = true;
        $this->winWidth = "width:" . filament('chatgpt-agent')->getDefaultPanelWidth() . ";";
        $this->winPosition = "";
        $this->showPositionBtn = true;
        $this->messages = session($this->sessionKey, []);
        $this->question = "";
        $this->name = filament('chatgpt-agent')->getBotName();
        $this->buttonText = filament('chatgpt-agent')->getButtonText();
        $this->buttonIcon = filament('chatgpt-agent')->getButtonIcon();
        $this->sendingText = filament('chatgpt-agent')->getSendingText();
    }

    public function render()
    {
        return view('filament-chatgpt-agent::livewire.chat-bot');
    }

    public function sendMessage(): void
    {
        if(empty(trim($this->question))){
            $this->question = "";
            return;
        }
        $this->messages[] = [
            "role" => 'user',
            "content" => $this->question,
        ];

        $this->dispatch('sendmessage', ['message' => $this->question]);
        $this->question = "";
        $this->chat();
    }

    public function changeWinWidth(): void
    {
        if($this->winWidth=="width:" . filament('chatgpt-agent')->getDefaultPanelWidth() . ";"){
            $this->winWidth = "width:100%;";
            $this->showPositionBtn = false;
        }else{
            $this->winWidth = "width:" . filament('chatgpt-agent')->getDefaultPanelWidth() . ";";
            $this->showPositionBtn = true;
        }
    }

    public function changeWinPosition(): void
    {
        if($this->winPosition != "left"){
            $this->winPosition = "left";
        }else{
            $this->winPosition = "";
        }
    }

    public function resetSession(): void
    {
        request()->session()->forget($this->sessionKey);
        $this->messages = [];
    }

    public function togglePanel(): void
    {
        $this->panelHidden = !$this->panelHidden;
    }

    protected function chat(): void
    {

        // if($response){
        //     $response = json_decode($response);
        // }

        // if (@$response->error) {
        //     $this->messages[] = ['role' => 'assistant', 'content' => $response->error->message];
        // } else {
        //     $this->messages[] = ['role' => 'assistant', 'content' => @$response->choices[0]->message->content];
        // }
        $this->messages[] = ['role' => 'assistant', 'content' => 'test response!'];

        request()->session()->put($this->sessionKey, $this->messages);

    }

}
