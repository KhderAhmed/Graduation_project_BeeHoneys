<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - CAPTCHA - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-yellow-100 via-green-50 to-green-200 min-h-screen flex items-center justify-center font-sans">

    <main class="w-full max-w-md px-6 py-8 rounded-2xl shadow-xl border border-white/20 bg-white/30 backdrop-blur-lg">
        <section>
            <h2 class="text-3xl font-extrabold text-green-800 mb-8 text-center">
                {{ __('messages.vnr') }}
            </h2>

            <form class="space-y-6" action="{{ route('verify-captcha') }}" method="POST">
                @csrf

                <!-- CAPTCHA -->
                <div>
                    <label for="captcha" class="block text-sm font-semibold text-gray-800 mb-2">
                        {{ __('messages.VC') }}
                    </label>

                    <!-- صورة + زر تحديث -->
                    <div class="flex items-center gap-3 mb-3">
                        <div class="rounded-lg border border-green-300 bg-white/70 shadow p-2">
                            <img src="/captcha-image" alt="CAPTCHA" id="captchaImage" class="h-16 w-44 object-contain">
                        </div>

                        <button type="button" onclick="refreshCaptcha()"
                            class="h-10 w-10 flex items-center justify-center rounded-full bg-green-100 hover:bg-green-200 border border-green-300 text-green-700 shadow-sm transition"
                            title="{{ __('messages.refresh_captcha') }}">
                            🔄
                        </button>
                    </div>

                    <p class="text-sm text-gray-500 mb-2">
                        {{ __('messages.clickrefresh') }}
                    </p>

                    <!-- حقل الإدخال -->
                    <input type="text" id="captcha" name="captcha"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/60 focus:bg-white 
                               focus:border-green-500 focus:ring-0 focus:outline-none transition
                               @error('captcha') border-red-500 @enderror"
                        placeholder="{{ __('messages.captcha_placeholder') }}">

                    @error('captcha')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- زر الإرسال -->
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white text-lg font-semibold shadow-md transition">
                    {{ __('messages.send') }}
                </button>
            </form>
        </section>
    </main>

    <script>
        function refreshCaptcha() {
            const captchaImage = document.getElementById('captchaImage');
            captchaImage.src = '/captcha-image?' + Math.random();
        }
    </script>
</body>
</html>
