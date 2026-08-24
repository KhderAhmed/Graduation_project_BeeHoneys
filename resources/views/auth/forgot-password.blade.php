<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bee Honey - Email Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body
    class="bg-gradient-to-br from-yellow-100 via-green-50 to-green-200 min-h-screen flex items-center justify-center font-sans">

    <main class="w-full max-w-md p-8 rounded-2xl shadow-xl border border-white/20 bg-white/30 backdrop-blur-lg">

        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @endif

        <section>
            <h2 class="text-3xl font-extrabold text-center text-green-800 mb-8">
                {{ __('messages.forgot password') }}
            </h2>

            <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf

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

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md transition">
                    {{ __('messages.send') }}
                </button>
            </form>
        </section>
    </main>

</body>

</html>
