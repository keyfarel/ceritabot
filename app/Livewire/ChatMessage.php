<?php

namespace App\Livewire;

use Livewire\Component;

class ChatMessage extends Component
{
    public $message;

    public function render()
    {
        return view('livewire.chat-message');
    }
}
