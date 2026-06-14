<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <Link href="/" class="text-2xl font-bold text-blue-600">
              CreatorsWeb
            </Link>
          </div>
          <div class="flex items-center space-x-4">
            <Link href="/creator-dashboard" class="text-gray-700 hover:text-blue-600">
              Mi Página
            </Link>
            <Link href="/dashboard" class="text-gray-700 hover:text-blue-600">
              Dashboard
            </Link>
            <Link href="/profile" class="text-gray-700 hover:text-blue-600">
              Perfil
            </Link>
            <Link href="/logout" method="post" as="button" class="text-gray-700 hover:text-blue-600">
              Salir
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
