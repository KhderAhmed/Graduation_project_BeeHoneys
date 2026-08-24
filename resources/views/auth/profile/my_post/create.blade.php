<x-headerporofile />

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex flex-col">

    <x-navlinkporofile />

    <main class="container mx-auto px-6 py-12 flex-grow">
        <section class="bg-white/90 backdrop-blur-lg border border-white/20 p-8 rounded-2xl shadow-lg">
            <h2 class="text-3xl font-bold text-green-700 mb-8 text-center">
                {{ __('messages.create new post') }}
            </h2>

            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- العناوين -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_ar" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.title_ar') }}
                        </label>
                        <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none 
                                   focus:border-green-500 focus:ring-0 @error('title_ar') border-red-500 @enderror">
                        @error('title_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.title_en') }}
                        </label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none 
                                   focus:border-green-500 focus:ring-0 @error('title_en') border-red-500 @enderror">
                        @error('title_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- الوصف -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description_ar" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.description_ar') }}
                        </label>
                        <textarea id="description_ar" name="description_ar" rows="4"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none 
                                   focus:border-green-500 focus:ring-0 @error('description_ar') border-red-500 @enderror">{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.description_en') }}
                        </label>
                        <textarea id="description_en" name="description_en" rows="4"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none 
                                   focus:border-green-500 focus:ring-0 @error('description_en') border-red-500 @enderror">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- الصورة -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.image') }}
                    </label>
                    <input type="file" name="image" id="image"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none 
                               focus:border-green-500 focus:ring-0 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- زر الحفظ -->
                <div>
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                        {{ __('messages.save') }}
                    </button>
                </div>
            </form>
        </section>
    </main>

    <x-guestfooter />
</body>
</html>
