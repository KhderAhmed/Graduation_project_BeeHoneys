
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






<div class="min-h-screen bg-gradient-to-b from-yellow-200 via-yellow-100 to-yellow-300 flex flex-col items-center px-4 py-10 space-y-6">
    
    <div class="w-full max-w-3xl p-6 bg-white/30 backdrop-blur-md border border-white/20 rounded-3xl shadow-xl space-y-6">
        <h2 class="text-2xl font-bold text-yellow-900 drop-shadow-lg text-center mb-4">تفاصيل الخلية: {{ $hive->name }}</h2>

        <!-- اختيار الفترة -->
        <div class="flex justify-center gap-3 mb-4">
            <form method="GET" action="{{ route('hives.show', $hive->id) }}">
                <select name="period" onchange="this.form.submit()"
                    class="border border-white/30 rounded-lg p-3 bg-white/50 text-yellow-900 focus:ring-2 focus:ring-yellow-400 focus:bg-white/70 transition shadow-inner">
                    <option value="day" {{ $period === 'day' ? 'selected' : '' }}>آخر 24 ساعة</option>
                    <option value="week" {{ $period === 'week' ? 'selected' : '' }}>آخر أسبوع</option>
                    <option value="month" {{ $period === 'month' ? 'selected' : '' }}>آخر شهر</option>
                </select>
            </form>
        </div>

        <div class="bg-white/40 backdrop-blur-md border border-white/20 rounded-2xl shadow-inner p-4">
            <canvas id="hiveChart" class="rounded-lg"></canvas>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json($chartData);

    const ctx = document.getElementById('hiveChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: '🌡 الحرارة',
                    data: chartData.temperature,
                    borderColor: 'red',
                    backgroundColor: 'rgba(255,0,0,0.2)',
                    fill: true,
                    tension: 0.3,
                },
                {
                    label: '💧 الرطوبة',
                    data: chartData.humidity,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0,0,255,0.2)',
                    fill: true,
                    tension: 0.3,
                },
                {
                    label: '⚖ الوزن',
                    data: chartData.weight,
                    borderColor: 'green',
                    backgroundColor: 'rgba(0,255,0,0.2)',
                    fill: true,
                    tension: 0.3,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#78350F',
                        font: { weight: 'bold' }
                    }
                },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { ticks: { color: '#78350F' }, grid: { color: 'rgba(255,255,255,0.2)' } },
                y: { ticks: { color: '#78350F' }, grid: { color: 'rgba(255,255,255,0.2)' } }
            }
        }
    });
</script>
</html>