<div
    class="flex h-[80vh] bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-lg overflow-hidden shadow-lg">

    <!-- Sidebar: قائمة المحادثات -->
    <div class="w-72 border-r bg-white dark:bg-gray-800 flex flex-col">
        <div class="p-4 font-bold border-b border-gray-200 dark:border-gray-700 text-lg">
            📨 {{ __('messages.chats') }}
        </div>
        <div class="flex-1 overflow-y-auto divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($clients as $c)
                @php
                    $lastMessage = $c->messages->last();
                @endphp
                <button wire:click="selectClient({{ $c->id }})"
                    class="w-full text-left p-3 hover:bg-gray-100 dark:hover:bg-gray-700
                        {{ $currentClient && $currentClient->id === $c->id ? 'bg-blue-50 dark:bg-blue-900/30' : '' }}">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-semibold">{{ $c->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $lastMessage->message ?? '— لا توجد رسائل —' }}
                            </div>
                        </div>
                        @if ($lastMessage)
                            <div class="text-[10px] text-gray-400 dark:text-gray-500">
                                {{ $lastMessage->created_at->format('H:i') }}
                            </div>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Chat Card -->
    <div class="flex-1 flex flex-col p-4">
        @if ($currentClient)
            <div class="flex-1 flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">

                <!-- Header -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <div class="flex-1">
                        <div class="font-semibold text-lg text-black dark:text-white">{{ $currentClient->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $currentClient->email }}</div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto p-4 flex flex-col-reverse space-y-3 space-y-reverse">
                    @foreach ($messages->reverse() as $message)
                        <div
                            class="flex {{ $message->sender_type === App\Models\User::class ? 'justify-end' : 'justify-start' }}">
                            <div
                                class="px-4 py-2 rounded-2xl max-w-[70%] break-words
                                {{ $message->sender_type === App\Models\User::class
                                    ? 'bg-blue-500 text-white rounded-br-none shadow'
                                    : 'bg-gray-200 text-black rounded-bl-none shadow-sm' }}">
                                <div class="text-sm">{{ $message->message }}</div>
                                <div
                                    class="text-[10px] mt-1 opacity-70 text-right {{ $message->sender_type === App\Models\User::class ? 'text-white/80' : 'text-black/60' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Input -->
                <form wire:submit.prevent="sendMessage"
                    class="p-4 border-t border-gray-200 dark:border-gray-700 flex gap-3 items-center bg-gray-100 dark:bg-gray-900">
                    <input type="text" wire:model.defer="newMessage" wire:keydown.enter="sendMessage"
                        class="flex-1 px-4 py-3 text-base rounded-full border border-gray-300 dark:border-gray-600
                                  bg-white dark:bg-gray-700 text-black dark:text-white placeholder-gray-500
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                        placeholder="✍️ اكتب رسالتك هنا...">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                        {{ __('messages.send') }} 🚀
                    </button>
                </form>

            </div>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-500 dark:text-gray-400">

                {{ __('messages.ccfll') }}
            </div>
        @endif
    </div>
</div>
