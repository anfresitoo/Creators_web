<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Editar Perfil</h1>

        <!-- Mensaje de éxito flash -->
        <div v-if="$page.props.flash?.success" class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
          {{ $page.props.flash.success }}
        </div>

        <form @submit.prevent="updateProfile" class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              :class="{ 'border-red-500': errors.name }"
            />
            <p v-if="errors.name" class="text-sm text-red-600 mt-1">{{ errors.name }}</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              :class="{ 'border-red-500': errors.email }"
            />
            <p v-if="errors.email" class="text-sm text-red-600 mt-1">{{ errors.email }}</p>
          </div>

          <button
            type="submit"
            :disabled="isSubmitting"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 disabled:bg-gray-400"
          >
            {{ isSubmitting ? 'Guardando...' : 'Guardar cambios' }}
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
