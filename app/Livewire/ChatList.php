<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ChatList extends Component
{
    public $messages = [];
    public $newMessage = '';
    protected $adminId = 1; // ID الأدمن (ثابت)

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $clientId = Auth::guard('client')->id();

        $this->messages = ChatMessage::with('sender')
            ->where(function ($q) use ($clientId) {
                $q->where('sender_id', $clientId)
                    ->where('sender_type', Client::class)
                    ->where('receiver_id', $this->adminId)
                    ->where('receiver_type', User::class);
            })
            ->orWhere(function ($q) use ($clientId) {
                $q->where('sender_id', $this->adminId)
                    ->where('sender_type', User::class)
                    ->where('receiver_id', $clientId)
                    ->where('receiver_type', Client::class);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        $clientId = Auth::guard('client')->id();

        if (trim($this->newMessage) === '') return;

        ChatMessage::create([
            'sender_id'     => $clientId,
            'sender_type'   => Client::class,
            'receiver_id'   => $this->adminId,
            'receiver_type' => User::class,
            'message'       => $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat-list');
    }
}
