<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <Link href="/" class="text-2xl font-bold text-blue-600">
          CreatorsWeb
        </Link>
        <div class="space-x-4">
          <Link href="/login" class="text-gray-700 hover:text-blue-600">
            Iniciar sesión
          </Link>
          <Link href="/register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Registrarse
          </Link>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
      <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 text-center text-gray-600">
        <p>© 2024 CreatorsWeb. Apoya a tus creadores favoritos.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
