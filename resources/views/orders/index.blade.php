<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.old invoic') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-to-b from-green-300 via-green-200 to-green-100 min-h-screen flex flex-col text-gray-900 font-sans">
    <x-navlinkporofile />
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-extrabold bg-gradient-to-b from-green-300 via-green-200 to-green-100 mb-8 flex items-center gap-2 text-center">
            📁 {{ __('messages.old invoic') }}
        </h2>

        @foreach ($orders as $order)
            <div
                class="bg-white/60 backdrop-blur-md shadow-md rounded-2xl p-6 mb-6 border border-white/30 hover:shadow-xl transition">
                
                <div class="mb-3">
                    <span class="font-semibold text-green-700">📌 {{ __('messages.request number') }}:</span>
                    <span class="ml-1">{{ $order->id }}</span>
                </div>
                
                <div class="mb-3">
                    <span class="font-semibold text-green-700">🗓️ {{ __('messages.date') }}:</span>
                    <span class="ml-1">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                </div>
                
                <div class="mb-4">
                    <span class="font-semibold text-green-700">💰 {{ __('messages.total') }}:</span>
                    <span class="ml-1 font-bold text-gray-800">{{ $order->total_price }} رس</span>
                </div>
                
                <a href="{{ route('order.success', $order->id) }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl text-sm shadow-md transition transform hover:scale-105">
                    🔍 {{ __('messages.show detail') }}
                </a>
            </div>
        @endforeach
    </div>

    <footer
        class="bg-white/40 backdrop-blur-md border-t border-white/30 mt-auto p-4 text-green-900 text-center rounded-t-2xl shadow-lg">
        <p class="font-medium">&copy; 2025 Bee Honey. {{ __('messages.all rights reserved') }}</p>
    </footer>

</body>
</html>
