<template>
  <GuestLayout>
    <div class="w-full max-w-md relative z-10">
      <div class="bg-black/40 backdrop-blur-xl border border-white/10 rounded-2xl shadow-[0_0_40px_rgba(255,255,255,0.03)] p-8 relative overflow-hidden">
        <!-- Subtle glow behind the form -->
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-white opacity-5 blur-3xl rounded-full"></div>

        <div class="text-center mb-8 relative z-10">
          <h1 class="text-3xl font-black text-white mb-2 tracking-wide uppercase">Iniciar Sesión</h1>
          <p class="text-gray-400 text-sm tracking-widest uppercase">Accede a tu cuenta de CreatorsWeb</p>
        </div>

        <div v-if="status" class="mb-6 p-3 bg-white/10 border border-white/20 rounded-lg text-white text-sm backdrop-blur-md text-center">
          {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-5 relative z-10">
          <div>
            <label for="email" class="block text-xs font-bold text-gray-400 mb-1 uppercase tracking-wider">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              autofocus
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
              autocomplete="current-password"
              placeholder="••••••••"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent placeholder-gray-600 transition-all"
              :class="{ 'border-red-500/50 ring-red-500/20': form.errors.password }"
            />
            <p v-if="form.errors.password" class="mt-1 text-xs text-red-400 font-medium">{{ form.errors.password }}</p>
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center group cursor-pointer">
              <div class="relative flex items-center">
                <input
                  v-model="form.remember"
                  type="checkbox"
                  class="peer sr-only"
                />
                <div class="w-5 h-5 border border-white/20 rounded bg-white/5 peer-checked:bg-white peer-checked:border-white transition-all flex items-center justify-center">
                  <svg class="w-3 h-3 text-black opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
              </div>
              <span class="ml-3 text-xs text-gray-400 uppercase tracking-widest group-hover:text-gray-300 transition-colors">Recordarme</span>
            </label>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="w-full bg-white text-black font-black py-3.5 rounded-xl hover:bg-gray-200 disabled:bg-white/20 disabled:text-white/50 transition-all shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:shadow-[0_0_25px_rgba(255,255,255,0.3)] uppercase tracking-widest mt-2"
          >
            {{ form.processing ? 'INGRESANDO...' : 'INICIAR SESIÓN' }}
          </button>
        </form>

        <div class="mt-8 text-center relative z-10">
          <p class="text-gray-400 text-sm tracking-wide">
            ¿No tienes cuenta?
            <Link href="/register" class="text-white hover:text-gray-300 font-bold ml-1 border-b border-white/30 hover:border-white transition-all pb-0.5">
              Regístrate aquí
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

defineProps({
  status: String,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  });
};
</script>
