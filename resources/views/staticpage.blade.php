<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.Bee Honey') }} - Project & Developer Info</title>

    @vite(['resources/css/app.css', 'resources/js/protect.js'])
    <x-guesthead />
</head>

<body class="bg-gradient-to-br from-amber-50 via-emerald-50/60 to-green-100 min-h-screen text-gray-800 font-sans antialiased selection:bg-amber-500 selection:text-white flex flex-col justify-between">

    <!-- Header Navigation -->
    <x-guestlink />

    <!-- Main Container -->
    <main class="max-w-4xl w-full mx-auto my-10 px-4 sm:px-6">
        <div class="bg-white/60 backdrop-blur-md border border-white/40 shadow-xl rounded-3xl p-6 sm:p-10 transition duration-300">

            <!-- Header Title -->
            <header class="mb-8 text-center pb-6 border-b border-emerald-900/10">
                <div class="inline-flex items-center justify-center p-3 bg-amber-100/80 text-amber-700 rounded-2xl mb-3 shadow-inner">
                    <span class="text-3xl">📘</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-emerald-900 tracking-tight">
                    Project Overview & Developer Info
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-2 font-medium flex items-center justify-center gap-1">
                    <span>📅 Last updated: 12/6/2025 at 9:58 PM</span>
                </p>
            </header>

            <!-- Cards Container -->
            <section class="space-y-6">

                <!-- Developer Card -->
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-sm border-l-4 border-emerald-600 hover:shadow-md transition duration-200">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xl">👨‍💻</span>
                        <h2 class="text-lg font-bold text-emerald-900">Developer Profile</h2>
                    </div>
                    <div class="text-gray-700 space-y-1 font-medium">
                        <p class="text-base font-semibold text-gray-900">
                            Khder Gaber Ahmed 
                            <span class="text-xs font-normal text-emerald-800 bg-emerald-100 px-2.5 py-0.5 rounded-full ms-2 border border-emerald-200">IT Engineer</span>
                        </p>
                        <p class="text-sm text-gray-600">Software Engineering & Full-Stack Web Development</p>
                        <div class="pt-2">
                            <a href="https://github.com/KhderAhmed/" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center gap-2 text-sm text-emerald-700 hover:text-emerald-900 font-semibold transition hover:underline">
                                <span>🔗 View GitHub Profile</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Note 1: Tech Stack -->
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition duration-200">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xl">📝</span>
                        <h2 class="text-lg font-bold text-amber-900">System Architecture & Tech Stack</h2>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">
                        The project is officially titled <strong class="text-emerald-800">BeeHoney</strong>. It utilizes 
                        <strong class="text-gray-900">Tailwind CSS & Glassmorphism</strong> for the frontend, 
                        <strong class="text-gray-900">Laravel 12 with PHP, Blade Components, Livewire, and Filament Dashboard</strong> for the backend engine, paired with a <strong class="text-gray-900">SQLite</strong> database.
                    </p>
                </div>

                <!-- Note 2: Libraries & Modules -->
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition duration-200">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xl">📦</span>
                        <h2 class="text-lg font-bold text-amber-900">Integrated Libraries & Tooling</h2>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">
                        Key libraries and services integrated: 
                        <code class="bg-amber-100/80 text-amber-900 px-2 py-0.5 rounded text-xs font-mono border border-amber-200">DOMPDF / PDF Export</code>, 
                        <code class="bg-emerald-100/80 text-emerald-900 px-2 py-0.5 rounded text-xs font-mono border border-emerald-200">Filament Admin Panel</code>, 
                        <code class="bg-amber-100/80 text-amber-900 px-2 py-0.5 rounded text-xs font-mono border border-amber-200">Livewire 3</code>, 
                        <code class="bg-emerald-100/80 text-emerald-900 px-2 py-0.5 rounded text-xs font-mono border border-emerald-200">ApexCharts / Analytics</code>, and 
                        <code class="bg-amber-100/80 text-amber-900 px-2 py-0.5 rounded text-xs font-mono border border-amber-200">Laravel Localization (Lang)</code>.
                    </p>
                </div>

                <!-- Note 3: Authentication System -->
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition duration-200">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xl">🔐</span>
                        <h2 class="text-lg font-bold text-amber-900">Authentication & Security</h2>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">
                        Comprehensive User Authentication flow featuring: 
                        <strong class="text-gray-900">Login</strong>, 
                        <strong class="text-gray-900">User Registration</strong>, 
                        <strong class="text-gray-900">Role-based Admin Logic</strong>, 
                        <strong class="text-gray-900">Password Hashing</strong>, and automated 
                        <strong class="text-gray-900">Mail notifications for Forgot & Reset Password</strong> workflows.
                    </p>
                </div>

                <!-- Section Footer -->
                <div class="text-center pt-6 border-t border-emerald-900/10">
                    <span class="inline-flex items-center gap-2 text-sm font-bold text-emerald-800 bg-emerald-100/60 px-4 py-1.5 rounded-full border border-emerald-200">
                        🚀 THE END
                    </span>
                </div>

            </section>
        </div>
    </main>

    <!-- Footer Component -->
    <x-guestfooter />

</body>
</html>