<section class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Title Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-900 tracking-tight">
                {{ __('messages.oft') }}
            </h2>
            <div class="mt-2 h-1 w-16 bg-amber-500 mx-auto rounded-full"></div>
        </div>

        <!-- Beekeepers Grid -->
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($phones as $phone)
                <li class="bg-white/70 backdrop-blur-md rounded-2xl border border-amber-200/60 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <!-- Header / Name -->
                        <div class="flex items-center gap-3 mb-4 border-b border-amber-100/80 pb-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-lg shrink-0 border border-amber-200">
                                🐝
                            </div>
                            <div>
                                <span class="text-xs font-bold text-amber-700 block uppercase tracking-wider">
                                    {{ __('messages.name') }}
                                </span>
                                <h3 class="text-lg font-bold text-emerald-950 group-hover:text-amber-600 transition-colors">
                                    {{ $phone->{'name_' . app()->getLocale()} }}
                                </h3>
                            </div>
                        </div>

                        <!-- Contact Details -->
                        <div class="space-y-2.5 text-sm">
                            <!-- Email -->
                            <div class="flex items-center gap-2.5 text-gray-700 dir-ltr text-start">
                                <span class="p-1.5 rounded-lg bg-emerald-50 text-emerald-700 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <a href="mailto:{{ $phone->email }}" class="hover:underline font-medium text-emerald-900 truncate">
                                    {{ $phone->email }}
                                </a>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-center gap-2.5 text-gray-700 dir-ltr text-start">
                                <span class="p-1.5 rounded-lg bg-amber-50 text-amber-700 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                <a href="tel:{{ $phone->phone }}" class="hover:underline font-semibold text-emerald-950">
                                    {{ $phone->phone }}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>