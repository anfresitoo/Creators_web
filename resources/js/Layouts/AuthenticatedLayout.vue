<template>
  <div class="min-h-screen bg-dark-bg text-gray-200 font-sans">
    <!-- Navigation -->
    <nav class="bg-dark-panel border-b border-neon-cyan shadow-[0_0_15px_rgba(0,243,255,0.15)] relative z-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <Link href="/" class="text-2xl font-black tracking-widest text-neon-cyan drop-shadow-[0_0_8px_rgba(0,243,255,0.6)] uppercase">
              CreatorsWeb
            </Link>
          </div>
          <div class="flex items-center space-x-4">
            <Link href="/creator-dashboard" class="text-gray-300 hover:text-neon-cyan transition-colors font-medium tracking-wide">
              MI PÁGINA
            </Link>
            <Link href="/dashboard" class="text-gray-300 hover:text-neon-cyan transition-colors font-medium tracking-wide">
              DASHBOARD
            </Link>
            <Link href="/profile" class="text-gray-300 hover:text-neon-cyan transition-colors font-medium tracking-wide">
              PERFIL
            </Link>
            <Link href="/logout" method="post" as="button" class="text-gray-300 hover:text-neon-magenta transition-colors font-medium tracking-wide uppercase">
              SALIR
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 relative z-0">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
