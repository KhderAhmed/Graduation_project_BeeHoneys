<?php

namespace App\Livewire;
use App\Models\ChatMessage;
use App\Models\Client;
use App\Models\User;
use Livewire\Component;

class ChatAdmin extends Component
{
     public $clients;
    public $currentClientId = null;
    public $currentClient = null;
    public $messages = [];
    public $newMessage = '';
    protected $adminId = 1;

    public function mount(): void
    {

        $this->clients = Client::orderBy('name')->get();
    }

    public function selectClient(int $id): void
    {
        $this->currentClientId = $id;
        $this->currentClient = Client::find($id);
        $this->loadMessages();
    }

    public function loadMessages(): void
    {
        if (!$this->currentClientId) {
            $this->messages = [];
            return;
        }

        $this->messages = ChatMessage::with(['sender', 'receiver'])
            ->where(function($q) {
                $q->where('sender_id', $this->adminId)
                  ->where('sender_type', User::class)
                  ->where('receiver_id', $this->currentClientId)
                  ->where('receiver_type', Client::class);
            })
            ->orWhere(function($q) {
                $q->where('sender_id', $this->currentClientId)
                  ->where('sender_type', Client::class)
                  ->where('receiver_id', $this->adminId)
                  ->where('receiver_type', User::class);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }
public function sendMessage(): void
{
    if (!trim($this->newMessage) || !$this->currentClientId) return;

    ChatMessage::create([
        'sender_id'     => $this->adminId,
        'sender_type'   => User::class,
        'receiver_id'   => $this->currentClientId,
        'receiver_type' => Client::class,
        'message'       => $this->newMessage,
    ]);

    $this->newMessage = '';
    $this->loadMessages();
}
    public function render()
    {
        return view('livewire.chat-admin');
    }
}
