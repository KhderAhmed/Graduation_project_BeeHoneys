<x-headerporofile />

<body class="bg-gradient-to-b from-green-300 via-green-200 to-green-100 p-4 min-h-screen flex flex-col">
    <x-navlinkporofile />

    <main class="flex-grow container mx-auto px-6 py-12 flex flex-col items-center">
        
        <!-- ✅ رسائل النجاح / الحذف -->
        @if (session('success'))
            <x-flash-message msg="{{ session('success') }}" />
        @elseif(session('Delete'))
            <x-flash-message msg="{{ session('Delete') }}" bg="bg-red-500" />
        @endif

        <!-- ✅ تحديث الحساب -->
        <section class="w-full max-w-md mb-10">
            <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">
                {{ __('messages.update profile') }}
            </h2>

            <form class="bg-white/90 p-8 rounded-2xl shadow-lg border-t-4 border-green-600"
                  action="{{ route('profile.update') }}" method="POST">
                @csrf

                <!-- الاسم -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg 
                               focus:outline-none focus:border-green-500 focus:ring-0
                               @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- البريد -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.email') }}
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg 
                               focus:outline-none focus:border-green-500 focus:ring-0
                               @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.password') }}
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full p-3 border border-gray-300 rounded-lg 
                               focus:outline-none focus:border-green-500 focus:ring-0
                               @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.passwordc') }}
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full p-3 border border-gray-300 rounded-lg 
                               focus:outline-none focus:border-green-500 focus:ring-0
                               @error('password') border-red-500 @enderror">
                </div>

                <!-- زر حفظ -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                    {{ __('messages.save') }}
                </button>
            </form>
        </section>

        <!-- ✅ حذف الحساب -->
        <section class="w-full max-w-md">
            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('{{ __('messages.delete_confirmation') }}')">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition">
                    {{ __('messages.delete account') }}
                </button>
            </form>
        </section>
    </main>

    <x-guestfooter />
</body>
</html>
