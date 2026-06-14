<template>
  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card: Mi Página de Creador -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Mi Página de Creador</h3>
          <p class="text-gray-600 text-sm mb-4">Gestiona tu perfil, links y ve tus apoyos recibidos.</p>
          <Link href="/creator-dashboard" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Ir al dashboard
          </Link>
        </div>

        <!-- Card: Mi Perfil -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Perfil</h3>
          <p class="text-gray-600 text-sm mb-4">Actualiza tu información personal y configuración de cuenta.</p>
          <Link href="/profile" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Editar perfil
          </Link>
        </div>

        <!-- Card: Ayuda -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Ayuda</h3>
          <p class="text-gray-600 text-sm mb-4">¿Necesitas ayuda? Consulta nuestra documentación o contáctanos.</p>
          <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Ver ayuda
          </a>
        </div>
      </div>

      <!-- Stats -->
      <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Bienvenido al Dashboard</h2>
        <p class="text-gray-600">Desde aquí puedes gestionar tu página de creador y ver tus apoyos.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
