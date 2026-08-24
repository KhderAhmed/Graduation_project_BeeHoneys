<x-headerporofile />

<body class="bg-gradient-to-br from-yellow-50 to-green-100 text-gray-900">

    <x-navlinkporofile />
    <x-serchuserpost />

    <main class="container mx-auto px-4 py-12 space-y-16">
        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @elseif(session('Delete'))
            <x-flash-message msg="{{ session('Delete') }}" bg="bg-red-500" />
        @endif

        <!-- ✅ الصندوق الزجاجي -->
        <section
            class="max-w-7xl mx-auto 
                        bg-white/30 backdrop-blur-lg border border-white/20 
                        p-10 rounded-2xl shadow-2xl">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-extrabold text-green-700">
                    {{ __('messages.You Have') }}: {{ $blogs->total() }} {{ __('messages.posts') }}
                </h1>
                <a wire:navigate href="{{ route('post.create') }}"
                    class="bg-green-600 hover:bg-green-700 transition-colors duration-200 text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                    {{ __('messages.create new post') }}
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-300">
                <table class="w-full table-auto text-left">
                    <thead class="bg-green-100/50 text-green-900 backdrop-blur-sm">
                        <tr>
                            <th class="px-6 py-3">{{ __('messages.id') }}</th>
                            <th class="px-6 py-3">{{ __('messages.title') }}</th>
                            <th class="px-6 py-3">{{ __('messages.writer') }}</th>
                            <th class="px-6 py-3">{{ __('messages.created_at') }}</th>
                            <th class="px-6 py-3">{{ __('messages.update_at') }}</th>
                            <th class="px-6 py-3">{{ __('messages.description') }}</th>
                            <th class="px-6 py-3">{{ __('messages.image') }}</th>
                            <th class="px-6 py-3">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if ($blogs->isNotEmpty())
                            @foreach ($blogs as $blog)
                                <tr class="hover:bg-green-50/50 transition">
                                    <td class="px-6 py-4">{{ $blog->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $blog->{'title_' . app()->getLocale()} }}
                                    </td>
                                    <td class="px-6 py-4">{{ $blog->client->name }}</td>
                                    <td class="px-6 py-4">{{ $blog->created_at->format('Y-M-d') }}</td>
                                    <td class="px-6 py-4">{{ $blog->updated_at->format('Y-M-d') }}</td>
                                    <td class="px-6 py-4 max-w-sm truncate text-gray-700">
                                        {{ $blog->{'description_' . app()->getLocale()} }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <img class="h-12 w-12 object-cover rounded-full mx-auto"
                                            src="{{ asset('blog/' . $blog->image) }}" alt="Image">
                                    </td>
                                    <td class="px-6 py-4 flex items-center gap-4">
                                        <!-- زر التعديل -->
                                        <a href="{{ route('post.edit', $blog->id) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                            title="{{ __('messages.edit') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.688-1.688a2.25 2.25 0 113.182 3.182L10.5 17.313l-4.5 1.5 1.5-4.5 9.362-9.326z" />
                                            </svg>
                                        </a>

                                        <!-- زر الحذف -->
                                        <form action="{{ route('post.destroy', $blog->id) }}" method="POST"
                                            onsubmit="return confirm('{{ __('messages.delete_confirmation') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                title="{{ __('messages.delete') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">
                                    {{ __('messages.There Is no Posts In Page') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                @if ($blogs->isNotEmpty())
                    {{ $blogs->links() }}
                @endif
            </div>
        </section>
    </main>

    <x-guestfooter />
</body>

</html>
