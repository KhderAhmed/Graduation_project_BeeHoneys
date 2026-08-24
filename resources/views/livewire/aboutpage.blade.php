<section class="bg-green-50 py-16 rounded-xl shadow-inner">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-green-800 mb-6">{{ __('messages.about') }}</h2>
     
        <div class="mt-10 flex justify-center gap-6 flex-wrap">
            @foreach ($abouts as $item)
                <div class="bg-white/30 backdrop-blur-lg border border-white/20 rounded-2xl shadow-lg p-6 w-64 hover:shadow-2xl transition duration-300">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">
                        {{ $item->{'title_' . app()->getLocale()} }}
                    </h3>
                    <p class="text-gray-700">{{ $item->{'description_' . app()->getLocale()} }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
