<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<x-guesthead />

<body class="bg-gradient-to-br from-yellow-50 to-green-100 text-gray-900 font-sans">

    <x-guestlink />

    <main class="container mx-auto p-4">

        <div class="max-w-4xl mx-auto py-8">
            <div
                class="bg-white/60 backdrop-blur-md border border-white/30 rounded-2xl shadow-lg p-8 transition hover:shadow-xl">

                <!-- العنوان -->
                <h1 class="text-3xl font-extrabold text-green-800 mb-4">
                    {{ __('messages.title') }} :
                    <span class="text-gray-900 font-normal">
                        {{ $blo->{'title_' . app()->getLocale()} }}
                    </span>
                </h1>

                <!-- الوصف -->
                <div class="mt-4">
                    <p class="text-lg leading-relaxed text-gray-700">
                        <span class="font-semibold text-green-700">{{ __('messages.description') }} :</span>
                        {{ $blo->{'description_' . app()->getLocale()} }}
                    </p>
                </div>

                <!-- الكاتب -->
                <p class="text-sm text-gray-600 mt-6">
                    ✍️ <span class="font-semibold">{{ __('messages.writer') }}</span> :
                    <span class="text-green-800">{{ $blo->user->name }}</span>
                </p>

                <!-- زر الرجوع -->
                <div class="mt-6">
                    <a wire:navigate href="/generalpublications"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105">
                        ⬅️ {{ __('messages.go back') }}
                    </a>
                </div>

            </div>
        </div>

    </main>

    <x-guestfooter />

</body>

</html>
