<div class="flex flex-col h-screen bg-gradient-to-b from-green-400 via-green-300 to-green-200 p-4">

    <!-- Header -->
    <div class="bg-green-600 bg-opacity-70 backdrop-blur-md text-white p-4 font-bold text-lg rounded-t-xl shadow-md">
        الدردشة مع الدعم
    </div>

    <!-- Chat Messages -->
    <div class="flex-1 overflow-y-auto p-4 space-y-3 flex flex-col-reverse">
        @foreach ($messages->reverse() as $message)
            <div class="flex {{ auth('client')->id() == $message->sender_id && $message->sender_type === \App\Models\Client::class ? 'justify-end' : 'justify-start' }}">
                <div class="flex flex-col max-w-xs">
                    
                    <!-- Sender Name -->
                    <div class="text-[11px] font-semibold mb-1
                        {{ auth('client')->id() == $message->sender_id && $message->sender_type === \App\Models\Client::class ? 'text-green-900 text-right' : 'text-gray-700 text-left' }}">
                        {{ $message->sender->name ?? 'الدعم' }}
                    </div>

                    <!-- Message Bubble -->
                    <div
                        class="px-4 py-2 rounded-2xl shadow-lg relative
                        {{ auth('client')->id() == $message->sender_id && $message->sender_type === \App\Models\Client::class
                            ? 'bg-gradient-to-br from-green-600 to-green-700 text-white rounded-br-none backdrop-blur-sm'
                            : 'bg-white bg-opacity-50 text-gray-900 rounded-bl-none backdrop-blur-sm' }}">

                        <div class="text-base">{{ $message->message }}</div>

                        <!-- Timestamp -->
                        <div class="text-[10px] mt-1 opacity-70 text-right flex justify-end items-center gap-1">
                            <span>{{ $message->created_at->format('H:i') }}</span>
                            @if(auth('client')->id() == $message->sender_id && $message->sender_type === \App\Models\Client::class)
                                <!-- Sent / Read indicator -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white/70" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M1 12l5 5L23 1"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input Area -->
    <div class="p-3 bg-white bg-opacity-30 backdrop-blur-md border-t flex gap-2 rounded-b-xl shadow-inner">
        <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage"
               class="flex-1 border border-gray-300 rounded-full px-4 py-2 bg-white bg-opacity-30 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
               placeholder="اكتب رسالتك هنا...">
        <button wire:click="sendMessage"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full shadow-md transition transform hover:scale-105">
            إرسال
        </button>
    </div>

</div>
