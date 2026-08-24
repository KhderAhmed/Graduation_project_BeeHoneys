<section class="container mx-auto px-4 py-8">
    <div class="bg-white/50 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-green-100">
        <form action="" method="GET">
            <label for="search"
                class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.search') }}</label>
            <div class="flex flex-col sm:flex-row gap-2">
                <input type="text" name="Keyword" placeholder="Search..."
                    class="flex-1 px-4 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none bg-white/70 backdrop-blur-sm">
                
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold shadow-md hover:bg-green-700 hover:shadow-lg transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-400">
                    {{ __('messages.search') }}
                </button>

                <a href="{{ route('generalpublications.index') }}"
                    class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 hover:shadow-lg transition transform hover:scale-105">
                    {{ __('messages.clear') }}
                </a>
            </div>
        </form>
    </div>
</section>
