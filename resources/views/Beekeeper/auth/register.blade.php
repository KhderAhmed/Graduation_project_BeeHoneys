<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Register</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-yellow-200 via-yellow-100 to-yellow-300 min-h-screen flex items-center justify-center">
    <main class="w-full max-w-md p-8 bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl">
        <section>
            <h2 class="text-3xl font-bold text-yellow-900 mb-6 text-center drop-shadow-lg">{{ __('messages.Create New Account') }}</h2>

            <form action="{{ route('postregisterbeekeeper') }}" method="POST" class="space-y-4">
                @csrf

                <!-- الاسم -->
                <div>
                    <label for="name" class="block text-sm font-medium text-yellow-900 mb-1">{{ __('messages.name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-yellow-900 placeholder-yellow-700 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner"
                        @error('name') ring-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label for="email" class="block text-sm font-medium text-yellow-900 mb-1">{{ __('messages.email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-yellow-900 placeholder-yellow-700 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner"
                        @error('email') ring-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- كلمة المرور -->
                <div>
                    <label for="password" class="block text-sm font-medium text-yellow-900 mb-1">{{ __('messages.password') }}</label>
                    <input type="password" name="password"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-yellow-900 placeholder-yellow-700 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner"
                        @error('password') ring-red-500 @enderror">
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-yellow-900 mb-1">{{ __('messages.passwordc') }}</label>
                    <input type="password" name="password_confirmation"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-yellow-900 placeholder-yellow-700 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner">
                </div>

                <!-- زر التسجيل -->
                <button type="submit"
                    class="w-full bg-yellow-600 text-white font-semibold py-3 rounded-xl hover:bg-yellow-700 shadow-lg transition transform hover:scale-105 duration-300">
                    {{ __('messages.register') }}
                </button>

                <!-- رابط تسجيل الدخول -->
                <div class="mt-4 text-center text-yellow-900">
                    <p>{{ __('messages.haa') }} : 
                        <a href="{{ route('loginbeekeeper') }}" class="font-semibold hover:underline text-yellow-700">{{ __('messages.login') }}</a>
                    </p>
                </div>

            </form>
        </section>
    </main>
</body>
</html>
