<section class="bg-gradient-to-br from-green-50 to-green-100 py-12">
    <div class="container mx-auto px-4">

        <!-- عنوان صفحة التواصل -->
        <h2 class="text-4xl font-extrabold text-green-800 mb-10 text-center">
            {{ __('messages.contact') }}
        </h2>

        <!-- نموذج الاتصال مع Glassmorphism -->
        <form class="grid grid-cols-1 md:grid-cols-2 gap-6 
                     bg-white/30 backdrop-blur-md border border-white/20 
                     rounded-3xl shadow-lg p-6 md:p-10"
              wire:submit.prevent="submit">
            
            <!-- الاسم -->
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold text-green-800 mb-2">{{ __('messages.name') }}</label>
                <input type="text" id="name" name="name"
                    class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition"
                    wire:model="name">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- البريد الإلكتروني -->
            <div class="flex flex-col">
                <label for="email" class="text-lg font-semibold text-green-800 mb-2">{{ __('messages.email') }}</label>
                <input type="email" id="email" name="email"
                    class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition"
                    wire:model="email">
                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- الهاتف -->
            <div class="flex flex-col">
                <label for="phone" class="text-lg font-semibold text-green-800 mb-2">{{ __('messages.phone') }}</label>
                <input type="tel" id="phone" name="phone"
                    class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition"
                    wire:model="phone">
                @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- الرسالة -->
            <div class="flex flex-col md:col-span-2">
                <label for="message" class="text-lg font-semibold text-green-800 mb-2">{{ __('messages.message') }}</label>
                <textarea id="message" name="message" rows="5"
                    class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition"
                    wire:model="message"></textarea>
                @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- زر الإرسال -->
            <div class="md:col-span-2 text-center mt-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    {{ __('messages.send') }}
                </button>
            </div>
        </form>
    </div>
</section>
