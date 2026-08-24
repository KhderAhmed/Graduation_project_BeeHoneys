@props(['request', 'full' => false]) 

<div>
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white/40 backdrop-blur-md border border-white/30 rounded-2xl shadow-lg hover:shadow-xl transition p-6">
            
            <!-- العنوان -->
            <h1 class="text-3xl font-bold text-green-700 mb-2">
                {{ __('messages.title') }}: {{ $request->{'title_' . app()->getLocale()} }}
            </h1>

            <p class="text-gray-700 font-medium mb-4">
                ✍️ {{ __('messages.writer') }}: 
                <span class="text-green-800">{{ $request->client->name }}</span>
            </p>

            <!-- المحتوى -->
            <div class="flex flex-col sm:flex-row gap-6 items-start">
                <img src="{{ asset('blog/' . $request->image) }}" 
                     alt="Blog Image" 
                     class="rounded-xl w-40 h-40 object-cover shadow-md border border-green-100">

                <div class="flex-1">
                    @if ($full)
                        <p class="text-gray-800 leading-relaxed">
                            {{ __('messages.description') }}: {{ $request->{'description_' . app()->getLocale()} }}
                        </p>
                    @else
                        <p class="text-sm text-gray-700">
                            {{ __('messages.description') }}:
                            {{ Str::words($request->{'description_' . app()->getLocale()}, 12) }}
                        </p>
                        <a wire:navigate href="{{ route('show.cl', $request) }}"
                           class="mt-3 inline-block px-5 py-2 rounded-xl bg-green-600 text-white font-semibold shadow-md hover:bg-green-700 hover:shadow-lg transition">
                            📖 {{ __('messages.read more') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
