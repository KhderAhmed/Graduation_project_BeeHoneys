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

            <!-- رابط محاكاة -->
            <a href="{{ route('hive.simulator') }}"
                class="text-yellow-900 font-semibold hover:text-yellow-700 transition 
                      dark:text-gray-100 dark:hover:text-yellow-300">
                {{ app()->getLocale() === 'ar' ? 'المحاكاة' : 'Simulator' }}
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
                    العربية
                </option>
                <option value="{{ route('lang.switch', 'en') }}" @if (session('locale') == 'en') selected @endif>
                    English
                </option>
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

                    <!-- الملف الشخصي -->
                    <a href="{{ route('profile.beekeer') }}"
                        class="block px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
                              dark:text-gray-100 dark:hover:bg-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}
                    </a>

                    <!-- تسجيل خروج -->
                    <a href="{{ route('logout.beekeeper') }}"
                        class="w-full block text-left px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
          dark:text-gray-100 dark:hover:bg-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'تسجيل خروج' : 'Logout' }}
                    </a>

                </div>
            </div>
        </div>
    </nav>


    <!-- فورم محاكاة البيانات -->
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div
            class="w-full max-w-md p-6 bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl space-y-5">
            <h2 class="text-2xl font-bold text-center text-yellow-900 drop-shadow-lg dark:text-yellow-300">
                {{ app()->getLocale() === 'ar' ? 'محاكاة بيانات الخلية' : 'Hive Data Simulator' }}
            </h2>

            <!-- رسالة النجاح -->
            @if (session('success'))
                <div class="p-3 bg-green-200/70 text-green-900 rounded-lg border border-green-300 shadow-inner">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('hive.simulator') }}" method="POST" class="space-y-4">
                @csrf

                <!-- اختيار الخلية -->
                <div>
                    <label class="block text-sm font-medium text-yellow-900 dark:text-gray-200">
                        {{ app()->getLocale() === 'ar' ? 'الخلية' : 'Hive' }}
                    </label>
                    <select name="hive_id"
                        class="w-full border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 
                                   focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner
                                   dark:bg-gray-700 dark:text-gray-100">
                        <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الخلية' : 'Select Hive' }}
                        </option>
                        @foreach ($hives as $hive)
                            <option value="{{ $hive->id }}" {{ old('hive_id') == $hive->id ? 'selected' : '' }}>
                                {{ $hive->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('hive_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- الحرارة -->
                <div>
                    <label class="block text-sm font-medium text-yellow-900 dark:text-gray-200">🌡
                        {{ app()->getLocale() === 'ar' ? 'الحرارة' : 'Temperature' }}</label>
                    <input type="number" name="temperature" value="{{ old('temperature') }}" placeholder="مثال: 35"
                        class="w-full border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 
                                  focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner
                                  dark:bg-gray-700 dark:text-gray-100">
                    @error('temperature')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- الرطوبة -->
                <div>
                    <label class="block text-sm font-medium text-yellow-900 dark:text-gray-200">💧
                        {{ app()->getLocale() === 'ar' ? 'الرطوبة' : 'Humidity' }}</label>
                    <input type="number" name="humidity" value="{{ old('humidity') }}" placeholder="مثال: 60"
                        class="w-full border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 
                                  focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner
                                  dark:bg-gray-700 dark:text-gray-100">
                    @error('humidity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- الوزن -->
                <div>
                    <label class="block text-sm font-medium text-yellow-900 dark:text-gray-200">⚖
                        {{ app()->getLocale() === 'ar' ? 'الوزن' : 'Weight' }}</label>
                    <input type="number" name="weight" value="{{ old('weight') }}" placeholder="مثال: 10"
                        class="w-full border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 
                                  focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner
                                  dark:bg-gray-700 dark:text-gray-100">
                    @error('weight')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CO2 -->
                <div>
                    <label class="block text-sm font-medium text-yellow-900 dark:text-gray-200">🟢 CO₂</label>
                    <input type="number" name="co2" value="{{ old('co2') }}" placeholder="مثال: 400"
                        class="w-full border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 
                                  focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner
                                  dark:bg-gray-700 dark:text-gray-100">
                    @error('co2')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- زر الإرسال -->
                <button type="submit"
                    class="w-full bg-yellow-600 text-white py-3 rounded-xl hover:bg-yellow-700 shadow-lg 
                               transition transform hover:scale-105 duration-300 font-semibold">
                    {{ app()->getLocale() === 'ar' ? 'إرسال البيانات' : 'Submit Data' }}
                </button>
            </form>
        </div>
    </div>
</body>

</html>
