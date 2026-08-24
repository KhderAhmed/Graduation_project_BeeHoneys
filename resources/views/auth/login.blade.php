<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-200 via-green-100 to-green-50 font-sans">

    <main class="w-full max-w-md px-4">
        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @endif

        <section class="rounded-2xl shadow-xl border border-white/20 bg-white/30 backdrop-blur-lg p-8">
            <h2 class="text-3xl font-extrabold text-green-800 text-center mb-6">
                {{ __('messages.login') }}
            </h2>

            <form action="{{ route('postlogin') }}" method="post" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.email') }}
                    </label>
                    <input type="email" id="email" name="email"
                        class="w-full p-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-400 transition
                               @error('email') border-red-500 ring-red-300 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.password') }}
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full p-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-400 transition
                               @error('password') border-red-500 ring-red-300 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="remember" class="ml-2 text-sm text-gray-700 select-none">
                        {{ __('messages.remember') }}
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md transition">
                    {{ __('messages.login') }}
                </button>

                <!-- Forgot Password -->
                <div class="text-sm text-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-red-600 hover:text-red-700 font-medium">
                        {{ __('messages.forgot password') }} ?
                    </a>
                </div>

                <!-- Register -->
                <div class="text-sm text-center mt-2">
                    <span class="text-gray-700">{{ __('messages.Create New Account') }} :</span>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        {{ __('messages.register') }}
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
