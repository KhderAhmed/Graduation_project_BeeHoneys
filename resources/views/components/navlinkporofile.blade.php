<div x-data="{ open: false }" class="w-full">
    <nav class="bg-green-600 p-3 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- الشعار -->
            <a class="text-white text-lg font-bold">{{ __('messages.Bee Honey') }}</a>

            <!-- زر القائمة (hamburger) للموبايل -->
            <button @click="open = !open" class="text-white md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- القائمة الأساسية على الشاشات الكبيرة -->
            <ul class="hidden md:flex space-x-4 items-center text-white text-sm md:text-base">
                <li><a wire:navigate href="/my-post" class="hover:text-gray-200">{{ __('messages.my post') }}</a></li>
                <li><a wire:navigate href="{{ route('cart.index') }}"
                        class="hover:text-gray-200">{{ __('messages.cart') }}</a></li>
                <li><a wire:navigate href="/home" class="hover:text-gray-200">{{ __('messages.home') }}</a></li>
                <li><a wire:navigate href="{{ route('chat') }}"
                        class="hover:text-gray-200">{{ __('messages.chat') }}</a></li>
                <li><a wire:navigate href="/logout" class="hover:text-gray-200">{{ __('messages.logout') }}</a></li>
                <li><a wire:navigate href="{{ route('order.old') }}"
                        class="hover:text-gray-200">{{ __('messages.old invoic') }}</a></li>
                <li><a wire:navigate href="/profile"
                        class="hover:text-gray-200">{{ Auth::guard('client')->user()->name }}</a></li>
                <li>
                    <select onchange="window.location.href = this.value"
                        class="bg-green-600 border border-green-400 text-white rounded px-2 py-1 focus:outline-none">
                        <option value="{{ route('lang.switch', 'ar') }}"
                            @if (session('locale') == 'ar') selected @endif>العربية</option>
                        <option value="{{ route('lang.switch', 'en') }}"
                            @if (session('locale') == 'en') selected @endif>English</option>
                    </select>
                </li>
            </ul>
        </div>

        <!-- القائمة المنسدلة في الموبايل -->
        <div x-show="open" @click.outside="open = false" class="md:hidden mt-3 space-y-2" x-transition>
            <a @click="open = false" wire:navigate href="/my-post"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.my post') }}</a>
            <a @click="open = false" wire:navigate href="/home"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.home') }}</a>
            <a @click="open = false" wire:navigate href="{{ route('chat') }}"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.chat') }}</a>
            <a @click="open = false" wire:navigate href="/logout"
                class="block text-white px-4 hover:bg-green-700">{{ __('messages.logout') }}</a>
            <a @click="open = false" wire:navigate href="/profile"
                class="block text-white px-4 hover:bg-green-700">{{ Auth::guard('client')->user()->name }}</a>
            <li><a wire:navigate href="{{ route('cart.index') }}"
                    class="hover:text-gray-200">{{ __('messages.cart') }}</a></li>
            <div class="px-4">
                <select onchange="window.location.href = this.value"
                    class="w-full bg-white text-black rounded px-2 py-1">
                    <option value="{{ route('lang.switch', 'ar') }}" @if (session('locale') == 'ar') selected @endif>
                        العربية</option>
                    <option value="{{ route('lang.switch', 'en') }}" @if (session('locale') == 'en') selected @endif>
                        English</option>
                </select>
            </div>
        </div>
    </nav>
</div>

<!-- Alpine.js لتفعيل التفاعل -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
