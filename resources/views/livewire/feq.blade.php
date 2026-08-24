<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-emerald-900 tracking-tight">
            {{ __('messages.Frequently Asked Questions') }}
        </h1>
        <div class="mt-2 h-1 w-20 bg-amber-500 mx-auto rounded-full"></div>
    </div>

    <!-- FAQ Accordion List -->
    <div class="space-y-4">
        @foreach ($faqs as $faq)
            <div x-data="{ open: false }" 
                 class="bg-white/70 backdrop-blur-md border border-amber-200/60 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                
                <!-- Toggle Button (Question) -->
                <button @click="open = !open" 
                        :aria-expanded="open"
                        class="w-full text-start px-6 py-4.5 bg-gradient-to-r from-amber-50/50 to-emerald-50/30 hover:from-amber-100/60 hover:to-emerald-100/40 transition-colors flex justify-between items-center gap-4 text-base sm:text-lg font-bold text-emerald-950 focus:outline-none focus:ring-2 focus:ring-amber-500/50 rounded-2xl">
                    
                    <span class="flex items-center gap-2">
                        <span class="text-amber-600 font-extrabold">؟</span>
                        <span>{{ $faq->{'question_' . app()->getLocale()} }}</span>
                    </span>

                    <!-- Animated Arrow Icon -->
                    <div class="p-1 rounded-full bg-amber-100/80 text-amber-800 shrink-0 transition-transform duration-300"
                         :class="{ 'rotate-180 bg-amber-500 text-white': open }">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>

                <!-- Answer Drawer -->
                <div x-show="open" 
                     x-collapse
                     x-cloak
                     class="px-6 py-5 text-gray-700 bg-white/50 border-t border-amber-100/60 text-sm sm:text-base leading-relaxed">
                    <div class="flex items-start gap-3">
                        <span class="inline-block px-2 py-0.5 text-xs font-bold bg-emerald-100 text-emerald-800 rounded-md shrink-0 mt-0.5">
                            {{ __('messages.Answer') }}
                        </span>
                        <div class="text-emerald-950 font-medium">
                            {!! nl2br(e($faq->{'answer_' . app()->getLocale()})) !!}
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>