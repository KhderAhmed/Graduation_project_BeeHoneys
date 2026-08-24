<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<x-guesthead />

<body class="bg-gradient-to-br from-yellow-50 to-green-100 text-gray-900 font-sans">

    <!-- روابط عامة -->
    <x-guestlink />

    <main class="container mx-auto p-4">

        <div class="max-w-4xl mx-auto py-10">
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-lg p-8 border border-white/30">
                
                <!-- العنوان -->
                <h1 class="text-3xl font-extrabold text-green-800 flex items-center gap-2">
                    📝 {{ __('messages.title') }} :
                    <span class="text-gray-900">{{ $req->{'title_' . app()->getLocale()} }}</span>
                </h1>

                <!-- الوصف -->
                <div class="mt-6">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        <span class="font-semibold text-green-700">{{ __('messages.description') }}:</span>
                        {{ $req->{'description_' . app()->getLocale()} }}
                    </p>
                </div>

                <!-- الكاتب -->
                <p class="mt-6 text-gray-600 text-sm">
                    ✍️ <span class="font-semibold text-green-800">{{ __('messages.writer') }}:</span> {{ $req->client->name }}
                </p>

                <!-- زر العودة -->
                <div class="mt-8">
                    <a wire:navigate href="/generalpublications"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-semibold shadow-md transition transform hover:scale-105">
                        ⬅️ {{ __('messages.go back') }}
                    </a>
                </div>

            </div>
        </div>

    </main>

    <!-- الفوتر -->
    <x-guestfooter />

</body>
</html>
