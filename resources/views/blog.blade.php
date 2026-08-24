<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<x-guesthead />

<body class="bg-gradient-to-br from-yellow-50 to-green-100 text-gray-900 font-sans">

    <!-- روابط عامة -->
    <x-guestlink />

    <!-- هيدر المدونة -->
    <x-headerblog />

    <!-- مربع البحث -->
    <x-serchblogpage />

    <!-- قسم المدونات العامة -->
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-extrabold text-green-800 mb-6 text-center">📚 {{ __('messages.blog') }}</h2>
        
      
            @foreach ($data as $blog)
                <x-adminblog :blog="$blog" />
            @endforeach
        </div>

        <!-- روابط التصفح -->
        <div class="mt-6 flex justify-center">
            {{ $data->links() }}
        </div>
    </main>

    <!-- فاصل ديكوري -->
   

    <!-- قسم مدونات العملاء -->
    <main class="container mx-auto px-4 py-8">

        
          <div class="space-y-6">
            @foreach ($requests as $request)
                <div class="bg-white/60 backdrop-blur-md border border-white/30 rounded-2xl shadow-lg p-6 transition hover:shadow-xl">
                    <x-clientblog :request="$request" />
                </div>
            @endforeach
        </div>

        <!-- روابط التصفح -->
        <div class="mt-6 flex justify-center">
            {{ $requests->links() }}
        </div>
    </main>

    <!-- الفوتر -->
    <x-guestfooter />

</body>
</html>
