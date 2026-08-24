<div class="bg-gradient-to-br from-green-50 to-green-100 py-12">
  <main class="container mx-auto px-4">

    <!-- About / Category Title -->
    <section class="text-center mb-12">
      <h1 class="text-4xl sm:text-5xl font-extrabold text-green-800 mb-4 tracking-tight">
        {{ __('messages.category') }}
      </h1>
    </section>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

      <!-- Bee Category -->
      <a href="/bee" class="group block rounded-3xl overflow-hidden bg-white/30 backdrop-blur-md border border-white/20 shadow-md hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="relative h-56 overflow-hidden rounded-t-3xl">
          <img 
            src="{{ asset('Front/img/vendor-5.jpg') }}" 
            alt="{{ __('messages.bee') }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            loading="lazy"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
        </div>
        <div class="p-6 text-center">
          <h2 class="text-2xl font-semibold text-green-800 group-hover:text-green-600 transition-colors duration-300">
            {{ __('messages.bee') }}
          </h2>
        </div>
      </a>

      <!-- Honey Category -->
      <a href="/honey" class="group block rounded-3xl overflow-hidden bg-white/30 backdrop-blur-md border border-white/20 shadow-md hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="relative h-56 overflow-hidden rounded-t-3xl">
          <img 
            src="{{ asset('Front/img/product-4.jpg') }}" 
            alt="{{ __('messages.honey') }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            loading="lazy"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
        </div>
        <div class="p-6 text-center">
          <h2 class="text-2xl font-semibold text-green-800 group-hover:text-green-600 transition-colors duration-300">
            {{ __('messages.honey') }}
          </h2>
        </div>
      </a>

      <!-- Queen Category -->
      <a href="/queen" class="group block rounded-3xl overflow-hidden bg-white/30 backdrop-blur-md border border-white/20 shadow-md hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="relative h-56 overflow-hidden rounded-t-3xl">
          <img 
            src="{{ asset('Front/img/product-1.jpg') }}" 
            alt="{{ __('messages.queen') }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            loading="lazy"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
        </div>
        <div class="p-6 text-center">
          <h2 class="text-2xl font-semibold text-green-800 group-hover:text-green-600 transition-colors duration-300">
            {{ __('messages.queen') }}
          </h2>
        </div>
      </a>



    </div>
  </main>
</div>
