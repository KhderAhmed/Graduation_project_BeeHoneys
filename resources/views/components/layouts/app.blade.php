<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bee Honey</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  @livewireStyles
</head>

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex flex-col text-gray-900">

    {{-- start nav --}}
    <x-navlink />
    {{-- end nav --}}

    {{ $slot }}


    <footer class="bg-green-700 text-white text-center p-4">
        <p>&copy; 2025 Bee Honey. All rights reserved.</p>
    </footer>
    @livewireScripts
</body>

</html>

</body>
{{-- php artisan make:component navlink
php artisan make:livewire HomePages --}}
