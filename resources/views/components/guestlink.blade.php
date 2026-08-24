<div x-data="{ open: false }" class="w-full">
    <nav class="bg-green-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('wel.pag') }}" class="text-white text-xl font-bold">
                {{ __('messages.Bee Honey') }}
                </a>

            <!-- زر القائمة (موبايل فقط) -->
            <button @click="open = !open" class="text-white md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    
                </svg>
                </button>

            <!-- القائمة العادية (أجهزة أكبر من الموبايل) -->
            <ul class="hidden md:flex space-x-4">
                <li><a wire:navigate href="{{ route('wel.pag') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.welcome') }}</a></li>
                <li><a wire:navigate href="{{ route('generalpublications.index') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.blog') }}</a></li>
                <li><a wire:navigate href="{{ route('ask-json.form') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.quai') }}</a></li>
                <li><a wire:navigate href="{{ route('faq.index') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.Frequently Asked Questions') }}</a></li>
                <li><a wire:navigate href="{{ route('login') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.login') }}</a></li>
                <li><a wire:navigate href="{{ route('info.dev') }}"
                        class="text-white hover:text-gray-200">{{ __('messages.staticpage') }}</a></li>
                <li>
                    <select class="text-black rounded px-2 py-1"
                        onchange="window.location.href = this.value">
                        <option value="{{ route('lang.switch', 'ar') }}"
                            @if (session('locale') == 'ar') selected @endif>العربية</option>
                        <option value="{{ route('lang.switch', 'en') }}"
                            @if (session('locale') == 'en') selected @endif>English</option>
                        </select>
                    </li>
                </ul>
            </div>

        <!-- القائمة المنسدلة للموبايل -->
        <div x-show="open" @click.outside="open = false" class="md:hidden mt-4 space-y-2" x-transition>
            <a @click="open = false" wire:navigate href="{{ route('wel.pag') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.welcome') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('generalpublications.index') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.blog') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('ask-json.form') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.quai') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('faq.index') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.Frequently Asked Questions') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('login') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.login') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('info.dev') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.staticpage') }}</a>
            <div class="px-4">
                <select class="w-full rounded px-2 py-1 text-black"
                    onchange="window.location.href = this.value">
                    <option value="{{ route('lang.switch', 'ar') }}"
                        @if (session('locale') == 'ar') selected @endif>
                        العربية</option>
                    <option value="{{ route('lang.switch', 'en') }}"
                        @if (session('locale') == 'en') selected @endif>
                        English</option>
                    </select>
                </div>
            </div>
        </nav>
</div>

<!-- Alpine.js (مطلوب لتفعيل التفاعل) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
