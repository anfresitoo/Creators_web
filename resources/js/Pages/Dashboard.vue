<template>
  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card: Mi Página de Creador -->
        <div class="bg-dark-panel border border-neon-cyan/20 rounded-xl shadow-[0_0_15px_rgba(0,243,255,0.05)] p-6 hover:shadow-[0_0_20px_rgba(0,243,255,0.15)] hover:border-neon-cyan/50 transition-all">
          <h3 class="text-lg font-bold text-neon-cyan mb-4 uppercase tracking-wide">Mi Página de Creador</h3>
          <p class="text-gray-400 text-sm mb-6 leading-relaxed">Gestiona tu perfil, links y ve tus apoyos recibidos.</p>
          <Link href="/creator-dashboard" class="inline-block bg-neon-cyan text-dark-bg font-bold px-6 py-2 rounded-lg hover:bg-white hover:text-dark-bg hover:shadow-[0_0_15px_rgba(0,243,255,0.6)] transition-all uppercase tracking-wide">
            Ir al dashboard
          </Link>
        </div>

        <!-- Card: Mi Perfil -->
        <div class="bg-dark-panel border border-neon-magenta/20 rounded-xl shadow-[0_0_15px_rgba(255,0,255,0.05)] p-6 hover:shadow-[0_0_20px_rgba(255,0,255,0.15)] hover:border-neon-magenta/50 transition-all">
          <h3 class="text-lg font-bold text-neon-magenta mb-4 uppercase tracking-wide">Perfil</h3>
          <p class="text-gray-400 text-sm mb-6 leading-relaxed">Actualiza tu información personal y configuración de cuenta.</p>
          <Link href="/profile" class="inline-block bg-transparent border-2 border-neon-magenta text-neon-magenta font-bold px-6 py-2 rounded-lg hover:bg-neon-magenta hover:text-white hover:shadow-[0_0_15px_rgba(255,0,255,0.6)] transition-all uppercase tracking-wide">
            Editar perfil
          </Link>
        </div>

        <!-- Card: Ayuda -->
        <div class="bg-dark-panel border border-neon-green/20 rounded-xl shadow-[0_0_15px_rgba(57,255,20,0.05)] p-6 hover:shadow-[0_0_20px_rgba(57,255,20,0.15)] hover:border-neon-green/50 transition-all">
          <h3 class="text-lg font-bold text-neon-green mb-4 uppercase tracking-wide">Ayuda</h3>
          <p class="text-gray-400 text-sm mb-6 leading-relaxed">¿Necesitas ayuda? Consulta nuestra documentación o contáctanos.</p>
          <a href="https://github.com/anfresitoo/Creators_web" target="_blank" class="inline-block bg-transparent border-2 border-neon-green text-neon-green font-bold px-6 py-2 rounded-lg hover:bg-neon-green hover:text-dark-bg hover:shadow-[0_0_15px_rgba(57,255,20,0.6)] transition-all uppercase tracking-wide">
            Ver ayuda
          </a>
        </div>
      </div>

      <!-- Stats -->
      <div class="bg-dark-panel border border-dark-border rounded-xl shadow-lg p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-neon-cyan opacity-5 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <h2 class="text-3xl font-black text-gray-100 mb-4 tracking-tight">Bienvenido al Dashboard</h2>
        <p class="text-gray-400 text-lg">Desde aquí puedes gestionar tu página de creador y ver tus apoyos.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
