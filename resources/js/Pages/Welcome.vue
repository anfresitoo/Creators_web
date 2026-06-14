<template>
  <GuestLayout>
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Bienvenido a CreatorsWeb</h1>
        <p class="text-gray-600">La plataforma para que tus seguidores te apoyen económicamente</p>
      </div>

      <div class="bg-white rounded-lg shadow-md p-8 space-y-6">
        <div class="text-center">
          <h2 class="text-2xl font-bold text-gray-900 mb-4">¿Qué es CreatorsWeb?</h2>
          <p class="text-gray-600 mb-4">
            CreatorsWeb te permite recibir apoyo monetario de tus seguidores. Configura tu página, agrega tus links y comienza a recibir apoyos.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-4">
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-6 w-6 rounded-md bg-blue-600 text-white">✓</div>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Perfil personalizado</h3>
              <p class="text-gray-600 text-sm">Crea tu página con avatar, bio y links</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-6 w-6 rounded-md bg-blue-600 text-white">✓</div>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Recibe apoyos</h3>
              <p class="text-gray-600 text-sm">Tus seguidores pueden apoyarte monetariamente</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-6 w-6 rounded-md bg-blue-600 text-white">✓</div>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Gestiona tus links</h3>
              <p class="text-gray-600 text-sm">Organiza todos tus enlaces en un solo lugar</p>
            </div>
          </div>
        </div>

        <div class="border-t pt-6 space-y-3">
          <Link href="/register" class="w-full block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Crear cuenta
          </Link>
          <Link href="/login" class="w-full block text-center bg-gray-200 text-gray-900 py-2 rounded hover:bg-gray-300">
            Iniciar sesión
          </Link>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
  laravelVersion: String,
  phpVersion: String,
});
</script>
