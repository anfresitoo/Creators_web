<template>
  <div class="min-h-screen bg-dark-bg text-gray-200 flex flex-col font-sans">
    <!-- Header -->
    <div class="bg-dark-panel border-b border-neon-cyan shadow-[0_0_15px_rgba(0,243,255,0.15)] relative z-10">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <Link href="/" class="text-2xl font-black tracking-widest text-neon-cyan drop-shadow-[0_0_8px_rgba(0,243,255,0.6)] uppercase">
          CreatorsWeb
        </Link>
      </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 relative">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-dark-panel border-t border-dark-border mt-8 relative z-10">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm tracking-wide">
        <p>© 2026 CreatorsWeb. Todos los derechos reservados.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
