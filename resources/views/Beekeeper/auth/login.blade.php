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
            <h2 class="text-3xl font-bold text-yellow-900 mb-6 text-center drop-shadow-lg">{{ __('messages.login') }}</h2>
            
            <form class="bg-white/30 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-xl space-y-5" 
                action="{{ route('postloginbeekeeper') }}" method="post">
                @csrf

                <!-- البريد الإلكتروني -->
                <div>
                    <label for="email" class="block text-sm font-medium text-yellow-900 mb-2">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-3 border border-white/30 rounded-lg bg-white/50 text-yellow-900 placeholder-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition shadow-inner
                        @error('email') ring-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div>
                    <label for="password" class="block text-sm font-medium text-yellow-900 mb-2">{{ __('messages.password') }}</label>
                    <input type="password" name="password"
                        class="w-full p-3 border border-white/30 rounded-lg bg-white/50 text-yellow-900 placeholder-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition shadow-inner
                        @error('password') ring-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تذكرني -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="mr-2 h-4 w-4 text-yellow-600 focus:ring-yellow-400 border-white/30 rounded">
                    <label for="remember" class="text-sm text-yellow-900 select-none">{{ __('messages.remember') }}</label>
                </div>

                <!-- زر الدخول -->
                <button type="submit"
                    class="w-full bg-yellow-600 text-white font-semibold py-3 rounded-xl hover:bg-yellow-700 shadow-lg transition transform hover:scale-105 duration-300">
                    {{ __('messages.login') }}
                </button>

                <!-- رابط التسجيل -->
                <div class="mt-4 text-sm text-center">
                    <span class="text-yellow-900"> {{ __('messages.Create New Account') }} :</span>
                    <a href="{{ route('registerbeekeeper') }}" class="text-yellow-700 hover:text-yellow-800 font-medium transition"> {{ __('messages.register') }}</a>
                </div>

            </form>
        </section>
    </main>
</body>
</html>
