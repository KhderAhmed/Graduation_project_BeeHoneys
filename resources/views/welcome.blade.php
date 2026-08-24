<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

@vite(['resources/css/app.css', 'resources/js/protect.js'])
<x-guesthead />

<body class="bg-gradient-to-br from-yellow-50 via-green-50 to-green-100 text-gray-900">

    <x-guestlink />

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 space-y-16">
        <!-- من أنا -->
        <section class="bg-white/40 backdrop-blur-md border border-white/30 shadow-md rounded-2xl p-8">
            <h1 class="text-4xl font-bold text-green-800 mb-4">{{ __('messages.Who am I') }}?</h1>
            <p class="text-lg text-gray-700 leading-relaxed">
                {{ __('messages.about_me_en') }}
            </p>
        </section>

        <!-- الفيديو -->
        <section class="bg-white/40 backdrop-blur-md border border-white/30 shadow-md rounded-2xl p-6">
            <livewire:video-page />
            </section>

        <!-- الفريق -->
        <section class="bg-white/40 backdrop-blur-md border border-white/30 shadow-md rounded-2xl p-6">
            <livewire:team-work />
            </section>

        <!-- نبذة -->
        <section class="bg-white/40 backdrop-blur-md border border-white/30 shadow-md rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-green-800 mb-4">{{ __('messages.about') }}</h2>
            <p class="text-lg text-gray-700 leading-relaxed">{{ __('messages.aboutpublic') }}</p>
            </section>

        <!-- المنتجات -->
        <section>
            <h2 class="text-3xl font-bold text-green-800 mb-8">{{ __('messages.product') }}</h2>
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <li
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-xl transition">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">{{ __('messages.bee') }}
                    </h3>
                    <p class="text-gray-700">{{ __('messages.wbee') }}</p>
                    </li>
                <li
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-xl transition">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">{{ __('messages.queen') }}
                    </h3>
                    <p class="text-gray-700">{{ __('messages.wqeen') }}</p>
                    </li>
                <li
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-xl transition">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">
                        {{ __('messages.honey') }}</h3>
                    <p class="text-gray-700">{{ __('messages.whoney') }}</p>
                    </li>
                </ul>
            </section>

        <!-- الخدمات -->
        <section>
            <h2 class="text-3xl font-bold text-green-800 mb-8">{{ __('messages.services') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <p class="text-gray-700">{{ __('messages.servicesl') }}</p>
                    </div>
                <div
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <p class="text-gray-700">{{ __('messages.servicesll') }}</p>
                    </div>
                <div
                    class="bg-white/40 backdrop-blur-md border border-white/30 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <p class="text-gray-700">{{ __('messages.serviceslll') }}</p>
                    </div>
                </div>
            </section>

        
    </main>
    <script>
        window.__PROTECT_USER = @json(auth()->check() ? auth()->user()->name : 'مستخدم مجهول');
    </script>
    <!-- Footer -->
    <x-guestfooter />

</body>

</html>
