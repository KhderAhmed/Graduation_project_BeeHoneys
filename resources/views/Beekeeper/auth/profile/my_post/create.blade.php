<x-headerporofile />

<body class="bg-gradient-to-br from-green-50 to-green-100">

    <x-navlinkporofile />
    <main class="container mx-auto p-6">
        <section class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">{{ __('messages.create new post') }}</h2>
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_ar"
                            class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.title_ar') }}</label>
                        <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('title_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title_en"
                            class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.title_en') }}</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('title_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description_ar"
                            class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description_ar') }}</label>
                        <input type="text" id="description_ar" name="description_ar"
                            value="{{ old('description_ar') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('description_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description_en"
                            class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description_en') }}</label>
                        <input type="text" id="description_en" name="description_en"
                            value="{{ old('description_en') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('description_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="image"
                        class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.image') }}</label>
                    <input type="file" name="image" id="image"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-green-700 text-white py-3 rounded-lg hover:bg-green-800 transition">{{ __('messages.save') }}</button>
                </div>
            </form>
        </section>
    </main>

    <x-guestfooter />
</body>

</html>
