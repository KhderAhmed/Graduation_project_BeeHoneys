<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Login</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-yellow-200 via-yellow-100 to-yellow-300 min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <section class="w-full max-w-md">
          <div class="min-h-screen bg-gradient-to-b from-yellow-200 via-yellow-100 to-yellow-300 flex items-center justify-center px-4"> 
    <div class="w-full max-w-md p-6 bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-semibold mb-5 text-yellow-900 drop-shadow-lg text-center">أدخل كود الدخول</h2>

        {{-- رسائل الفيدباك --}}
        @if (session('message'))
            <div class="mb-4 text-red-600 bg-white/40 p-2 rounded-lg border border-red-200 shadow-inner">
                {{ session('message') }}
            </div>
        @endif

        {{-- الفورم --}}
        <form action="{{ route('redeem.code') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="codeInput"
                class="w-full p-3 rounded-lg border border-white/30 bg-white/50 placeholder-yellow-700 text-yellow-900 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner"
             value="{{ old('codeInput') }}">

            {{-- أخطاء الفالديشن --}}
            @error('codeInput')
                <div class="text-sm text-red-700">{{ $message }}</div>
            @enderror

            <button type="submit"
                class="w-full bg-yellow-600 text-white py-3 rounded-xl hover:bg-yellow-700 shadow-lg transition font-semibold">
                دخول
            </button>
        </form>
    </div>
</div>
        </section>
    </main>
</body>
</html>












