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

            <a href="{{ route('hive.simulator') }}"
                class="block px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
                              dark:text-gray-100 dark:hover:bg-gray-700">
                New
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

                        <a href="{{ route('logout.beekeeper') }}"
                            class="w-full block text-left px-4 py-2 text-sm text-yellow-900 hover:bg-yellow-100 
          dark:text-gray-100 dark:hover:bg-gray-700">
                            {{ app()->getLocale() === 'ar' ? 'تسجيل خروج' : 'Logout' }}
                        </a>


                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto space-y-8">

        <!-- الإحصائيات -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div
                class="bg-white/40 backdrop-blur-md border border-white/20 rounded-2xl shadow p-4 text-center dark:bg-gray-800/50 dark:border-gray-700">
                <div class="text-xl font-bold text-yellow-900 dark:text-yellow-300">{{ $hives->count() }}</div>
                <div class="text-sm text-yellow-800 dark:text-gray-300">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي الخلايا' : 'Total Hives' }}</div>
            </div>
            <div class="bg-green-100 rounded-2xl shadow p-4 text-center dark:bg-green-900/40">
                <div class="text-xl font-bold text-green-700 dark:text-green-300">
                    {{ $hives->where('status', 'ok')->count() }}</div>
                <div class="text-sm text-green-800 dark:text-green-200">
                    {{ app()->getLocale() === 'ar' ? 'خلايا نشطة' : 'Active' }}</div>
            </div>
            <div class="bg-yellow-100 rounded-2xl shadow p-4 text-center dark:bg-yellow-900/40">
                <div class="text-xl font-bold text-yellow-700 dark:text-yellow-300">
                    {{ $hives->where('status', 'warning')->count() }}</div>
                <div class="text-sm text-yellow-800 dark:text-yellow-200">
                    {{ app()->getLocale() === 'ar' ? 'تحتاج متابعة' : 'Warning' }}</div>
            </div>
            <div class="bg-red-100 rounded-2xl shadow p-4 text-center dark:bg-red-900/40">
                <div class="text-xl font-bold text-red-700 dark:text-red-300">
                    {{ $hives->where('status', 'danger')->count() }}</div>
                <div class="text-sm text-red-800 dark:text-red-200">
                    {{ app()->getLocale() === 'ar' ? 'خلايا بخطر' : 'Danger' }}</div>
            </div>
        </div>

        <!-- Header + Search -->
        <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
            <h1 class="text-3xl font-bold text-yellow-900 drop-shadow-lg dark:text-yellow-300">
                {{ app()->getLocale() === 'ar' ? 'الخلايا الخاصة بك' : 'Your Hives' }}
            </h1>
            <div class="w-full sm:w-1/3">
                <form method="GET" action="{{ route('hives.dashboard') }}" class="relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="{{ app()->getLocale() === 'ar' ? '🔍 ابحث باسم الخلية...' : '🔍 Search hive name...' }}"
                        class="w-full p-3 rounded-full border border-white/30 bg-white/70 placeholder-yellow-700 
                               text-yellow-900 focus:ring-2 focus:ring-yellow-400 focus:bg-white/90 transition shadow-inner
                               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-300 dark:text-gray-100" />
                </form>
            </div>
        </div>

        <!-- شبكة الخلايا -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($hives as $hive)
                <a href="{{ route('hives.show', $hive->id) }}"
                    class="block bg-white/40 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg p-5 
                          hover:scale-105 hover:shadow-2xl transition transform duration-300 space-y-4
                          dark:bg-gray-800/50 dark:border-gray-700">

                    <!-- العنوان + الحالة -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-yellow-900 dark:text-yellow-300">{{ $hive->name }}</h2>
                            <p class="text-sm text-yellow-700 dark:text-gray-400">{{ $hive->location }}</p>
                        </div>
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full 
                                     {{ $hive->status === 'ok' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : ($hive->status === 'warning' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300') }}">
                            {{ ucfirst($hive->status) }}
                        </span>
                    </div>

                    <!-- آخر قراءة -->
                    <div class="text-right text-sm text-yellow-700 dark:text-gray-300">
                        <div>{{ app()->getLocale() === 'ar' ? 'آخر قراءة' : 'Last Reading' }}</div>
                        <div class="font-medium">
                            {{ optional($hive->latestReading)->created_at?->format('d/m H:i') ?? '-' }}
                        </div>
                    </div>

                    <!-- القراءات -->
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-yellow-50 rounded-lg p-2 dark:bg-yellow-900/40">🌡
                            {{ app()->getLocale() === 'ar' ? 'حرارة:' : 'Temp:' }}
                            <span class="font-bold">{{ optional($hive->latestReading)->temperature ?? '-' }} °C</span>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-2 dark:bg-blue-900/40">💧
                            {{ app()->getLocale() === 'ar' ? 'رطوبة:' : 'Humidity:' }}
                            <span class="font-bold">{{ optional($hive->latestReading)->humidity ?? '-' }} %</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-2 dark:bg-gray-700">⚖
                            {{ app()->getLocale() === 'ar' ? 'وزن:' : 'Weight:' }}
                            <span class="font-bold">{{ optional($hive->latestReading)->weight ?? '-' }} kg</span>
                        </div>
                        <div class="bg-green-50 rounded-lg p-2 dark:bg-green-900/40">🟢 CO₂:
                            <span class="font-bold">{{ optional($hive->latestReading)->co2 ?? '-' }} ppm</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-yellow-900 font-semibold dark:text-gray-300">
                    {{ app()->getLocale() === 'ar' ? 'لا توجد خلايا حتى الآن.' : 'No hives yet.' }}
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $hives->withQueryString()->links() }}
        </div>
    </div>
</body>

</html>
