<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
          <div class="text-6xl mb-4">🚀</div>
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Crea tu Página de Creador</h1>
          <p class="text-gray-600">¡Es momento de recibir apoyo de tus seguidores!</p>
        </div>

        <!-- Mensaje de éxito flash -->
        <div v-if="$page.props.flash?.success" class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
          {{ $page.props.flash.success }}
        </div>

        <form @submit.prevent="submitSetup" class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre público (Opcional)</label>
            <input
              v-model="form.display_name"
              type="text"
              maxlength="100"
              placeholder="Tu nombre de creador (ej: Juan Gameplays)"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              :class="{ 'border-red-500': errors.display_name }"
            />
            <p v-if="errors.display_name" class="text-sm text-red-600 mt-1">{{ errors.display_name }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Este nombre se mostrará en tu página pública. Si lo dejas vacío, se usará tu nombre de cuenta.
            </p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tu Slug (URL)</label>
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden" :class="{ 'border-red-500': errors.slug }">
              <span class="px-4 py-2 bg-gray-100 text-gray-600 border-r border-gray-300">/@</span>
              <input
                v-model="form.slug"
                type="text"
                required
                pattern="[a-z0-9_-]+"
                placeholder="tu-nombre-unico"
                class="flex-1 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <p v-if="errors.slug" class="text-sm text-red-600 mt-1">{{ errors.slug }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Usa solo letras minúsculas, números, guiones y guiones bajos. Esta será tu URL pública.
            </p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Biografía (Opcional)</label>
            <textarea
              v-model="form.bio"
              maxlength="500"
              rows="4"
              placeholder="Cuéntales sobre ti, tu contenido, por qué deberían apoyarte..."
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              :class="{ 'border-red-500': errors.bio }"
            ></textarea>
            <p v-if="errors.bio" class="text-sm text-red-600 mt-1">{{ errors.bio }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ form.bio?.length || 0 }}/500 caracteres</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Avatar URL (Opcional)</label>
            <input
              v-model="form.avatar_url"
              type="url"
              placeholder="https://ejemplo.com/tu-avatar.jpg"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              :class="{ 'border-red-500': errors.avatar_url }"
            />
            <p v-if="errors.avatar_url" class="text-sm text-red-600 mt-1">{{ errors.avatar_url }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Ingresa la URL a una imagen de perfil. Recomendamos una imagen cuadrada.
            </p>
          </div>

          <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-900">
              <strong>💡 Tip:</strong> Puedes usar sitios como Gravatar, ImageShack o cualquier servicio de alojamiento de imágenes.
            </p>
          </div>

          <button
            type="submit"
            :disabled="isSubmitting"
            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 disabled:bg-gray-400 transition text-lg"
          >
            {{ isSubmitting ? 'Creando tu página...' : 'Crear mi página de creador' }}
          </button>
        </form>

        <div class="mt-8 pt-8 border-t border-gray-200">
          <h3 class="font-semibold text-gray-900 mb-4">¿Qué incluye tu página?</h3>
          <ul class="space-y-2 text-sm text-gray-600">
            <li>✓ URL pública personalizada</li>
            <li>✓ Perfil con avatar y biografía</li>
            <li>✓ Gestor de enlaces (tipo Linktree)</li>
            <li>✓ Recepción de apoyos monetarios</li>
            <li>✓ Dashboard para administrar apoyos</li>
          </ul>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const isSubmitting = ref(false);
const errors = reactive({});

const form = reactive({
  slug: '',
  display_name: '',
  bio: '',
  avatar_url: '',
});

const submitSetup = () => {
  isSubmitting.value = true;

  // Limpiar errores previos
  Object.keys(errors).forEach(key => delete errors[key]);

  router.put('/creator/update', form, {
    onSuccess: () => {
      router.visit('/creator-dashboard');
    },
    onError: (validationErrors) => {
      Object.assign(errors, validationErrors);
    },
    onFinish: () => {
      isSubmitting.value = false;
    },
  });
};
</script>

