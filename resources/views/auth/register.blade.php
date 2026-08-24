<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-yellow-100 via-green-50 to-green-200 text-gray-900 min-h-screen flex items-center justify-center font-sans">

    <main class="w-full max-w-md p-8 rounded-2xl shadow-xl border border-white/20 bg-white/30 backdrop-blur-lg">
        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @endif

        <section>
            <h2 class="text-3xl font-extrabold text-green-800 mb-8 text-center">
                {{ __('messages.Create New Account') }}
            </h2>

            <form action="{{ route('postregister') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white 
                               focus:border-green-500 focus:ring-0 focus:outline-none transition
                               @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.email') }}
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white 
                               focus:border-green-500 focus:ring-0 focus:outline-none transition
                               @error('email') border-red-500 @enderror">
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
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white 
                               focus:border-green-500 focus:ring-0 focus:outline-none transition
                               @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.passwordc') }}
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white 
                               focus:border-green-500 focus:ring-0 focus:outline-none transition">
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md transition">
                    {{ __('messages.register') }}
                </button>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-700">
                        {{ __('messages.haa') }} :
                        <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">
                            {{ __('messages.login') }}
                        </a>
                    </p>
                </div>
            </form>
        </section>
    </main>

</body>
</html>
