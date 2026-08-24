<x-headerporofile />

<body class="bg-gradient-to-br from-green-50 to-green-100">

    <x-navlinkporofile />
    <main class="container mx-auto p-6">
        <section class="bg-white p-8 rounded-2xl shadow-xl">
            <h2 class="text-3xl font-extrabold text-green-700 mb-8 text-center">
                {{ __('messages.update post') }}...
            </h2>
            <form action="{{ route('post.update', $blog->id) }}" method="post" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_ar" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.title_ar') }}
                        </label>
                        <input type="text" id="title_ar" name="title_ar"
                            value="{{ old('title_ar', $blog->title_ar) }}"
                            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('title_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="title_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.title_en') }}
                        </label>
                        <input type="text" id="title_en" name="title_en"
                            value="{{ old('title_en', $blog->title_en) }}"
                            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('title_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description_ar" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.description_ar') }}
                        </label>
                        <textarea id="description_ar" name="description_ar"
                            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500"
                            rows="4">{{ old('description_ar', $blog->description_ar) }}</textarea>
                        @error('description_ar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.description_en') }}
                        </label>
                        <textarea id="description_en" name="description_en"
                            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500"
                            rows="4">{{ old('description_en', $blog->description_en) }}</textarea>
                        @error('description_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('messages.image') }}
                        </label>
                        <input type="file" name="image" id="image"
                            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @if (!empty($blog->image))
                            <img src="{{ asset('/blog/' . $blog->image) }}"
                                class="mt-4 w-full max-w-xs rounded-xl shadow-md" alt="Post Image">
                        @endif
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-green-700 text-white py-3 rounded-xl hover:bg-green-800 transition duration-200">
                        {{ __('messages.save') }}
                    </button>
                </div>
            </form>
        </section>
    </main>
    <x-guestfooter />
</body>

</html>
