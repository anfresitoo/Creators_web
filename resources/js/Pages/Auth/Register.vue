<template>
  <GuestLayout>
    <div class="w-full max-w-md relative z-10">
      <div class="bg-black/40 backdrop-blur-xl border border-white/10 rounded-2xl shadow-[0_0_40px_rgba(255,255,255,0.03)] p-8 relative overflow-hidden">
        <!-- Subtle glow behind the form -->
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-white opacity-5 blur-3xl rounded-full"></div>

        <div class="text-center mb-8 relative z-10">
          <h1 class="text-3xl font-black text-white mb-2 tracking-wide uppercase">Crear Cuenta</h1>
          <p class="text-gray-400 text-sm tracking-widest uppercase">Únete a CreatorsWeb</p>
        </div>

        <form @submit.prevent="submit" class="space-y-5 relative z-10">
          <div>
            <label for="name" class="block text-xs font-bold text-gray-400 mb-1 uppercase tracking-wider">Nombre completo</label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              required
              autofocus
              autocomplete="name"
              placeholder="Tu nombre"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent placeholder-gray-600 transition-all"
              :class="{ 'border-red-500/50 ring-red-500/20': form.errors.name }"
            />
            <p v-if="form.errors.name" class="mt-1 text-xs text-red-400 font-medium">{{ form.errors.name }}</p>
          </div>

          <div>
            <label for="email" class="block text-xs font-bold text-gray-400 mb-1 uppercase tracking-wider">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              autocomplete="username"
              placeholder="tu@email.com"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent placeholder-gray-600 transition-all"
              :class="{ 'border-red-500/50 ring-red-500/20': form.errors.email }"
            />
            <p v-if="form.errors.email" class="mt-1 text-xs text-red-400 font-medium">{{ form.errors.email }}</p>
          </div>

          <div>
            <label for="password" class="block text-xs font-bold text-gray-400 mb-1 uppercase tracking-wider">Contraseña</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              required
              autocomplete="new-password"
              placeholder="Mínimo 8 caracteres"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent placeholder-gray-600 transition-all"
              :class="{ 'border-red-500/50 ring-red-500/20': form.errors.password }"
            />
            <p v-if="form.errors.password" class="mt-1 text-xs text-red-400 font-medium">{{ form.errors.password }}</p>
          </div>

          <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-400 mb-1 uppercase tracking-wider">Confirmar contraseña</label>
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              required
              autocomplete="new-password"
              placeholder="Repite tu contraseña"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent placeholder-gray-600 transition-all"
            />
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="w-full bg-white text-black font-black py-3.5 rounded-xl hover:bg-gray-200 disabled:bg-white/20 disabled:text-white/50 transition-all shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:shadow-[0_0_25px_rgba(255,255,255,0.3)] uppercase tracking-widest mt-4"
          >
            {{ form.processing ? 'CREANDO...' : 'CREAR MI CUENTA' }}
          </button>
        </form>

        <div class="mt-8 text-center relative z-10">
          <p class="text-gray-400 text-sm tracking-wide">
            ¿Ya tienes cuenta?
            <Link href="/login" class="text-white hover:text-gray-300 font-bold ml-1 border-b border-white/30 hover:border-white transition-all pb-0.5">
              Inicia sesión
            </Link>
          </p>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post('/register', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>
