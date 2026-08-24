<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 py-10 px-4 sm:px-6 lg:px-8">
    <main class="max-w-4xl mx-auto rounded-3xl p-8 space-y-8 bg-white/20 backdrop-blur-md border border-white/30 shadow-lg">

        <!-- رسالة نجاح الطلب -->
        <div class="space-y-2 text-center">
            <h1 class="text-4xl font-extrabold text-green-800">✅ {{ __('messages.execute the request success') }}!</h1>
            <p class="text-xl text-gray-900">{{ __('messages.request number') }} : 
                <span class="font-semibold text-black">#{{ $order->id }}</span>
            </p>
            <p class="text-xl text-gray-900">💰 {{ __('messages.total') }}: 
                <span class="font-semibold text-black">{{ $order->total_price }} ر.س</span>
            </p>
        </div>

        <!-- الأزرار -->
        <div class="flex flex-col md:flex-row items-center justify-center md:justify-between gap-4 flex-wrap">
            <form action="{{ route('order.invoice.email', $order->id) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="bg-white text-green-800 font-semibold px-5 py-3 rounded-xl flex items-center gap-2 transition transform hover:scale-105 shadow-md hover:bg-green-600 hover:text-white">
                    📧 {{ __('messages.send invoic your email') }}
                </button>
            </form>

            <a href="{{ route('invoice.download', ['orderId' => $order->id]) }}" 
               class="bg-white text-green-800 font-semibold px-5 py-3 rounded-xl flex items-center gap-2 transition transform hover:scale-105 shadow-md hover:bg-green-600 hover:text-white">
                📥 {{ __('messages.donlowd pdf') }}
            </a>
        </div>

        <!-- جدول المنتجات -->
        <div class="overflow-x-auto rounded-xl border border-white/30 shadow-md">
            <table class="min-w-full text-center">
                <!-- تغير لون th -->
                <thead class="bg-green-200 text-green-900 backdrop-blur-sm">
                    <tr>
                        <th class="py-3 px-4 border-b-2">🛒 {{ __('messages.product') }}</th>
                        <th class="py-3 px-4 border-b-2">💵 {{ __('messages.price') }}</th>
                        <th class="py-3 px-4 border-b-2">🔢 {{ __('messages.quantity') }}</th>
                        <th class="py-3 px-4 border-b-2">🧮 {{ __('messages.total') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white/20 backdrop-blur-sm divide-y divide-white/20">
                    @foreach ($order->items as $item)
                        <tr class="transition hover:bg-white/40 cursor-pointer">
                            <td class="py-4 px-4 font-medium text-gray-900">{{ $item->product->{'title_' . app()->getLocale()} }}</td>
                            <td class="py-4 px-4 text-green-800 font-semibold">{{ $item->price }} ر.س</td>
                            <td class="py-4 px-4 text-gray-900">{{ $item->quantity }}</td>
                            <td class="py-4 px-4 font-semibold text-gray-900">{{ $item->price * $item->quantity }} ر.س</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- رابط الطلبات القديمة -->
        <div class="text-center">
            <a href="{{ route('order.old') }}" 
               class="inline-block mt-4 bg-white text-green-800 font-semibold px-6 py-3 rounded-xl transition transform hover:scale-105 shadow-md hover:bg-green-600 hover:text-white">
                🔁 {{ __('messages.show old request') }}
            </a>
        </div>

    </main>
</div>
