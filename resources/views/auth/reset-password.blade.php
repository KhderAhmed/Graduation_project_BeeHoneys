<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-yellow-100 via-green-50 to-green-200 text-gray-900 min-h-screen flex items-center justify-center font-sans">

    <main class="w-full max-w-md px-6 py-8 rounded-2xl shadow-xl border border-white/20 bg-white/30 backdrop-blur-lg">

        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @endif

        <section>
            <h2 class="text-3xl font-extrabold text-green-800 mb-8 text-center">
                {{ __('messages.resent') }}
            </h2>

            <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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
                    class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white text-lg font-semibold shadow-md transition">
                    {{ __('messages.save') }}
                </button>
            </form>
        </section>
    </main>

</body>
</html>
