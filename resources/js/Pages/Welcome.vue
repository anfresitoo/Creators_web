<template>
  <GuestLayout>
    <div class="w-full max-w-md relative z-10">
      <div class="text-center mb-10">
        <h1 class="text-4xl sm:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-neon-cyan to-neon-magenta mb-4 drop-shadow-[0_0_10px_rgba(0,243,255,0.4)] tracking-tight uppercase">
          Bienvenido a CreatorsWeb
        </h1>
        <p class="text-gray-400 text-lg tracking-wide">La plataforma para que tus seguidores te apoyen económicamente</p>
      </div>

      <div class="bg-dark-panel border border-neon-cyan/30 rounded-xl shadow-[0_0_25px_rgba(0,243,255,0.1)] p-8 space-y-8 backdrop-blur-sm">
        <div class="text-center">
          <h2 class="text-2xl font-bold text-gray-100 mb-4 tracking-wide uppercase">¿Qué es CreatorsWeb?</h2>
          <p class="text-gray-400 mb-4 leading-relaxed">
            CreatorsWeb te permite recibir apoyo monetario de tus seguidores. Configura tu página, agrega tus links y comienza a recibir apoyos.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-6">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-neon-cyan text-dark-bg font-black shadow-[0_0_10px_rgba(0,243,255,0.6)]">✓</div>
            </div>
            <div>
              <h3 class="font-bold text-gray-100 tracking-wide">Perfil personalizado</h3>
              <p class="text-gray-400 text-sm mt-1">Crea tu página con avatar, bio y links</p>
            </div>
          </div>
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-neon-magenta text-white font-black shadow-[0_0_10px_rgba(255,0,255,0.6)]">✓</div>
            </div>
            <div>
              <h3 class="font-bold text-gray-100 tracking-wide">Recibe apoyos</h3>
              <p class="text-gray-400 text-sm mt-1">Tus seguidores pueden apoyarte monetariamente</p>
            </div>
          </div>
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-neon-green text-dark-bg font-black shadow-[0_0_10px_rgba(57,255,20,0.6)]">✓</div>
            </div>
            <div>
              <h3 class="font-bold text-gray-100 tracking-wide">Gestiona tus links</h3>
              <p class="text-gray-400 text-sm mt-1">Organiza todos tus enlaces en un solo lugar</p>
            </div>
          </div>
        </div>

        <div class="border-t border-dark-border pt-8 space-y-4">
          <Link href="/register" class="w-full block text-center bg-neon-cyan text-dark-bg font-bold py-3 rounded hover:bg-white hover:text-dark-bg hover:shadow-[0_0_20px_rgba(0,243,255,0.6)] transition-all tracking-wider uppercase">
            Crear cuenta
          </Link>
          <Link href="/login" class="w-full block text-center bg-transparent border-2 border-neon-magenta text-neon-magenta font-bold py-3 rounded hover:bg-neon-magenta hover:text-white hover:shadow-[0_0_20px_rgba(255,0,255,0.6)] transition-all tracking-wider uppercase">
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
