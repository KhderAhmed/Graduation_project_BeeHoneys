<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-green-800 mb-8 text-center">📦 {{ __('messages.old request') }}</h1>

    <div class="space-y-4">
        @foreach ($orders as $order)
            <div x-data="{ open: false }" 
                 class="bg-white/30 backdrop-blur-md border border-white/20 rounded-xl shadow-md overflow-hidden transition hover:shadow-xl">
                
                <!-- رأس الطلب -->
                <button @click="open = !open"
                    class="w-full px-4 py-3 bg-green-100/50 hover:bg-green-200/50 flex justify-between items-center font-semibold text-green-700 transition">
                    <span>
                        {{ __('messages.request number') }} #{{ $order->id }} | {{ __('messages.date') }}:
                        {{ $order->created_at->format('Y-m-d H:i') }} | {{ number_format($order->total_price, 2) }} ر.س
                    </span>
                    <span x-text="open ? '-' : '+' " class="text-xl"></span>
                </button>

                <!-- تفاصيل الطلب -->
                <div x-show="open" x-transition class="bg-white/30 backdrop-blur-md px-4 py-3 text-gray-700 transition-all duration-300">
                    <div class="mb-2 flex flex-wrap gap-4">
                        <a href="#" class="text-blue-600 hover:underline flex items-center gap-1">🔍 {{ __('messages.show detail') }}</a>
                        <a href="#" class="text-purple-600 hover:underline flex items-center gap-1">📄 {{ __('messages.donlowd pdf') }}</a>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($order->items as $item)
                            <li>
                                {{ $item->product->{'title_' . app()->getLocale()} }} - {{ __('messages.quantity') }}: {{ $item->quantity }} - {{ __('messages.price') }}: {{ number_format($item->price, 2) }} ر.س
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
