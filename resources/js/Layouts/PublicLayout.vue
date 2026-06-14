<template>
  <div class="min-h-screen bg-dark-bg text-gray-200 font-sans">
    <!-- Header -->
    <div class="bg-dark-panel border-b border-neon-cyan shadow-[0_0_15px_rgba(0,243,255,0.15)] relative z-10">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <Link href="/" class="text-2xl font-black tracking-widest text-neon-cyan drop-shadow-[0_0_8px_rgba(0,243,255,0.6)] uppercase">
          CreatorsWeb
        </Link>
        <div class="space-x-4 flex items-center">
          <Link href="/login" class="text-gray-300 hover:text-neon-cyan transition-colors font-medium">
            INICIAR SESIÓN
          </Link>
          <Link href="/register" class="bg-transparent border-2 border-neon-magenta text-neon-magenta px-4 py-2 rounded hover:bg-neon-magenta hover:text-dark-bg hover:shadow-[0_0_15px_rgba(255,0,255,0.5)] transition-all font-bold tracking-wider uppercase">
            REGISTRARSE
          </Link>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 relative z-0">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-dark-panel border-t border-dark-border mt-12 relative z-10">
      <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 text-center text-gray-500 text-sm tracking-wide">
        <p>© 2026 CreatorsWeb. Apoya a tus creadores favoritos.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
