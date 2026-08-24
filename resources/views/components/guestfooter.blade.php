
<script>

    window.__PROTECT_USER = @json(auth()->check() ? auth()->user()->name : 'مستخدم مجهول');
  </script>
  
  <footer class="bg-green-600 p-4 text-white text-center mt-12">
    <p class="text-sm">&copy; 2025 Bee Honey. All rights reserved.</p>
</footer>