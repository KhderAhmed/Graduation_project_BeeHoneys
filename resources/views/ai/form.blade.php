<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bee Honey - AI Form</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

    <!-- ✅ Script محسن لتفعيل اللودينغ مع BERT -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            if (!form) return;

            const submitButton = form.querySelector("button[type='submit']");
            if (!submitButton) return;

            let isSubmitting = false;
            const originalText = submitButton.innerHTML;

            form.addEventListener("submit", function(e) {
                // منع الإرسال إذا كان قيد التنفيذ
                if (isSubmitting) {
                    e.preventDefault();
                    return;
                }

                isSubmitting = true;
                submitButton.disabled = true;
                submitButton.innerHTML = `
 <svg class="animate-spin h-5 w-5 mr-2 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"> <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
<path class="opacity-75" fill="currentColor"
 d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
 </svg>
جاري الإرسال.......
`;

                // في حالة حدوث خطأ أو تأخير طويل، نعيد الزر بعد 35 ثانية
                setTimeout(function() {
                    if (submitButton.disabled === true) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalText;
                        isSubmitting = false;
                    }
                }, 35000);
            });
        });
    </script>
</head>

<body class="bg-gradient-to-br from-yellow-50 to-green-100 text-gray-900 min-h-screen flex flex-col">

    <!-- Navbar -->
    <x-guestlink />

    <!-- Centered Content -->
    <div class="flex-grow flex items-center justify-center px-4 py-6">
        <main class="w-full max-w-md p-8 bg-white/30 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl">

            <section>
                {{-- ✅ عرض النتيجة أولاً --}}
                @if (isset($question) && isset($answer))
                    <div class="mb-8 bg-green-50/60 backdrop-blur-md p-5 rounded-xl border border-green-200 shadow">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">📝 سؤالك:</h3>
                        <p class="text-gray-800 mb-4">{{ $question }}</p>

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">🤖 الرد (باستخدام
                            الذكاء الاصطناعي):</h3>
                        <p class="text-green-900 font-medium leading-relaxed">
                            {{ $answer }}</p>
                    </div>
                @endif

                {{-- 🔽 بعده مباشرة يظهر الفورم --}}
                <h2 class="text-2xl font-bold text-center text-green-700 mb-6">
                    🐝 اسأل عن النحل أو العسل
                </h2>

                <form class="space-y-6" action="{{ route('ask-json.ai') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" name="question" placeholder="🐝 اكتب سؤالك هنا..."
                            value="{{ old('question') }}" required
                            class="w-full px-4 py-3 border border-white/40 bg-white/30 backdrop-blur-lg
rounded-lg shadow-sm focus:ring-2 focus:ring-green-400 focus:outline-none placeholder-green-500">
                        @error('question')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror

                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 
rounded-lg shadow-lg transition duration-200 flex items-center justify-center">
                        إرسال
                    </button>
                </form>

                <p class="text-xs text-center text-gray-500 mt-4">
                    🧠 يعمل بتقنية BERT (الذكاء الاصطناعي) | أول مرة لكل سؤال قد تأخذ 3-5 ثواني، ثم
                    تصبح فورية
                </p>
            </section>
        </main>
    </div>

</body>

</html>
