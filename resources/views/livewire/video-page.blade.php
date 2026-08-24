<div class="py-12 px-4 sm:px-6 lg:px-8">
    <!-- Section Title -->
    <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-900 tracking-tight flex items-center justify-center gap-2">
            <span>{{ __('messages.video') }}</span>
            <span class="text-2xl">🐝</span>
        </h2>
        <div class="mt-2 h-1 w-16 bg-amber-500 mx-auto rounded-full"></div>
    </div>

    <!-- Responsive Video Grid -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($videos as $item)
            <div class="group relative bg-white/70 backdrop-blur-md rounded-2xl border border-amber-200/60 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                
                <!-- Video Container -->
                <div class="aspect-video w-full bg-slate-900 relative overflow-hidden">
                    <video class="w-full h-full object-cover" controls preload="metadata">
                        <source src="{{ asset('storage/' . $item->attachment) }}" type="video/mp4">
                        {{ __('messages.bnspv') }}
                    </video>
                </div>

                <!-- Optional Title/Details (if present) -->
                @if(isset($item->title))
                    <div class="p-4 bg-white/50 border-t border-amber-100/50">
                        <h3 class="text-sm font-bold text-emerald-950 truncate">
                            {{ $item->title }}
                        </h3>
                    </div>
                @endif

            </div>
        @endforeach
    </div>
</div>