<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark',
        lang: '{{ app()->getLocale() }}'
    }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee Honey - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body
    class="min-h-screen bg-gradient-to-b from-yellow-200 via-yellow-100 to-yellow-300 px-4 py-6 
             dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:text-gray-100 
             transition-colors duration-500 ease-in-out">

    <!-- Navbar -->
    <nav
        class="sticky top-0 z-50 max-w-6xl mx-auto flex items-center justify-between 
                bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl shadow-md px-6 py-4 mb-6
                dark:bg-gray-800/50 dark:border-gray-700 transition">
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-bold text-yellow-900 drop-shadow-lg dark:text-yellow-300">🐝 BeeHoney</span>
        </div>
        <div class="flex items-center space-x-4">

            <!-- الرئيسية -->
            <a href="{{ route('hives.dashboard') }}"
                class="text-yellow-900 font-semibold hover:text-yellow-700 transition 
                      dark:text-gray-100 dark:hover:text-yellow-300">
                {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
            </a>

            <!-- Dark Mode Switch -->
            <button @click="darkMode = !darkMode"
                class="p-2 rounded-full bg-yellow-200 hover:bg-yellow-300 transition 
                           dark:bg-gray-700 dark:hover:bg-gray-600">
                <span x-show="!darkMode" x-transition>🌙</span>
                <span x-show="darkMode" x-transition>☀️</span>
            </button>

            <!-- Language Switch -->
            <select class="text-black rounded px-2 py-1" onchange="window.location.href = this.value">
                <option value="{{ route('lang.switch', 'ar') }}" @if (session('locale') == 'ar') selected @endif>
                    العربية</option>
                <option value="{{ route('lang.switch', 'en') }}" @if (session('locale') == 'en') selected @endif>
                    English</option>
            </select>

            <!-- الحساب -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="text-yellow-900 font-semibold hover:text-yellow-700 transition 
                               dark:text-gray-100 dark:hover:text-yellow-300">
                    {{ app()->getLocale() === 'ar' ? 'الحساب ⬇' : 'Account ⬇' }}
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-yellow-200 py-2 z-50 
                            dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('profile.beekeer') }}"
                        class="block px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
                              dark:text-gray-100 dark:hover:bg-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}
                    </a>
                    <form class="inline" action="{{ route('logout.beekeeper') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
                                       dark:text-gray-100 dark:hover:bg-gray-700">
                            {{ app()->getLocale() === 'ar' ? 'تسجيل خروج' : 'Logout' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-6 space-y-8">

        <!-- زر حذف الحساب -->
        <section class="max-w-md mx-auto">
            <form
                class="bg-red-500/30 backdrop-blur-md border border-red-200 p-4 rounded-2xl shadow-lg hover:bg-red-600 transition"
                method="POST" action="{{ route('profilebeekeer.destroy') }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('{{ __('messages.delete_confirmation') }}')"
                    class="w-full font-bold text-white py-2 rounded-xl hover:scale-105 transition transform">
                    {{ __('messages.delete account') }}
                </button>
            </form>
        </section>

        <!-- الرسائل -->
        <section class="max-w-md mx-auto">
            @if (session('success'))
                <x-flash-message msg="{{ session('success') }}" />
            @elseif(session('Delete'))
                <x-flash-message msg="{{ session('Delete') }}" bg="bg-red-500/80" />
            @endif
        </section>

        <!-- تحديث الملف الشخصي -->
        <section class="w-full max-w-md mx-auto">
            <h2 class="text-3xl font-bold text-green-900 mb-6 text-center drop-shadow-lg">
                {{ __('messages.update profile') }} </h2>

            <form class="bg-white/30 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-xl space-y-4"
                action="{{ route('profilebeekeer.update') }}" method="POST">
                @csrf

                <!-- الاسم -->
                <div>
                    <label for="name"
                        class="block text-sm font-medium text-green-900 mb-1">{{ __('messages.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-green-900 placeholder-green-700 focus:ring-2 focus:ring-green-400 focus:bg-white/70 transition shadow-inner @error('name') ring-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-green-900 mb-1">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-green-900 placeholder-green-700 focus:ring-2 focus:ring-green-400 focus:bg-white/70 transition shadow-inner @error('email') ring-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div>
                    <label for="password"
                        class="block text-sm font-medium text-green-900 mb-1">{{ __('messages.password') }}</label>
                    <input type="password" name="password"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-green-900 placeholder-green-700 focus:ring-2 focus:ring-green-400 focus:bg-white/70 transition shadow-inner @error('password') ring-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-green-900 mb-1">{{ __('messages.passwordc') }}</label>
                    <input type="password" name="password_confirmation"
                        class="w-full p-3 rounded-lg border border-white/30 bg-white/50 text-green-900 placeholder-green-700 focus:ring-2 focus:ring-green-400 focus:bg-white/70 transition shadow-inner">
                </div>

                <!-- زر الحفظ -->
                <button type="submit"
                    class="w-full bg-green-600 text-white font-semibold py-3 rounded-xl hover:bg-green-700 shadow-lg transition transform hover:scale-105 duration-300">
                    {{ __('messages.save') }}
                </button>

            </form>
        </section>

    </main>

</body>

</html>
