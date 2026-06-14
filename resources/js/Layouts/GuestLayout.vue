<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">
    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <Link href="/" class="text-2xl font-bold text-blue-600">
          CreatorsWeb
        </Link>
      </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-8">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 text-center text-gray-600">
        <p>© 2024 CreatorsWeb. Todos los derechos reservados.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
