<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto">
      <div class="bg-dark-panel border border-neon-cyan/30 rounded-xl shadow-[0_0_15px_rgba(0,243,255,0.1)] p-8">
        <h1 class="text-3xl font-black text-gray-100 mb-6 uppercase tracking-wide">Editar Perfil</h1>

        <!-- Mensaje de éxito flash -->
        <div v-if="$page.props.flash?.success" class="mb-6 p-3 bg-green-900/30 border border-green-500/50 rounded-lg text-neon-green text-sm">
          {{ $page.props.flash.success }}
        </div>

        <form @submit.prevent="updateProfile" class="space-y-6">
          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Nombre completo</label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
              :class="{ 'border-red-500': errors.name }"
            />
            <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Email</label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
              :class="{ 'border-red-500': errors.email }"
            />
            <p v-if="errors.email" class="text-sm text-red-500 mt-1">{{ errors.email }}</p>
          </div>

          <button
            type="submit"
            :disabled="isSubmitting"
            class="w-full bg-neon-cyan text-dark-bg font-black py-4 rounded-xl hover:bg-white hover:text-dark-bg hover:shadow-[0_0_20px_rgba(0,243,255,0.6)] disabled:bg-gray-700 disabled:text-gray-500 transition-all text-lg uppercase tracking-widest mt-4"
          >
            {{ isSubmitting ? 'GUARDANDO...' : 'GUARDAR CAMBIOS' }}
          </button>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const page = usePage();
const isSubmitting = ref(false);
const errors = reactive({});

const form = reactive({
  name: page.props.auth.user.name,
  email: page.props.auth.user.email,
});

const updateProfile = () => {
  isSubmitting.value = true;

  // Limpiar errores previos
  Object.keys(errors).forEach(key => delete errors[key]);

  router.put('/profile', form, {
    onError: (validationErrors) => {
      Object.assign(errors, validationErrors);
    },
    onFinish: () => {
      isSubmitting.value = false;
    },
  });
};
</script>
