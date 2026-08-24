<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg text-center">
    <h1 class="text-xl font-semibold text-green-700 mb-4">Please verify your email through the link we've sent you.</h1>

    <p class="text-sm text-gray-600 mb-6">Didn't get the email?</p>

    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit"
            class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 transition-all duration-200">
            Send the email verification again
        </button>
    </form>
</div>
