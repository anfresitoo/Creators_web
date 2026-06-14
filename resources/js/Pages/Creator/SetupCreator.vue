<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto">
      <div class="bg-dark-panel border border-neon-cyan/30 rounded-xl shadow-[0_0_20px_rgba(0,243,255,0.1)] p-8">
        <div class="text-center mb-8">
          <div class="text-6xl mb-4 drop-shadow-[0_0_15px_rgba(0,243,255,0.6)]">🚀</div>
          <h1 class="text-3xl font-black text-gray-100 mb-2 uppercase tracking-wide">Crea tu Página de Creador</h1>
          <p class="text-gray-400">¡Es momento de recibir apoyo de tus seguidores!</p>
        </div>

        <!-- Mensaje de éxito flash -->
        <div v-if="$page.props.flash?.success" class="mb-4 p-3 bg-green-900/30 border border-green-500/50 rounded-lg text-neon-green text-sm">
          {{ $page.props.flash.success }}
        </div>

        <form @submit.prevent="submitSetup" class="space-y-6">
          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Nombre público (Opcional)</label>
            <input
              v-model="form.display_name"
              type="text"
              maxlength="100"
              placeholder="Tu nombre de creador (ej: Juan Gameplays)"
              class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
              :class="{ 'border-red-500': errors.display_name }"
            />
            <p v-if="errors.display_name" class="text-sm text-red-500 mt-1">{{ errors.display_name }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Este nombre se mostrará en tu página pública. Si lo dejas vacío, se usará tu nombre de cuenta.
            </p>
          </div>

          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Tu Slug (URL)</label>
            <div class="flex items-center border border-dark-border bg-dark-bg rounded-lg overflow-hidden focus-within:border-neon-cyan focus-within:ring-1 focus-within:ring-neon-cyan" :class="{ 'border-red-500': errors.slug }">
              <span class="px-4 py-3 bg-dark-panel text-gray-500 border-r border-dark-border font-bold">/@</span>
              <input
                v-model="form.slug"
                type="text"
                required
                pattern="[a-z0-9_-]+"
                placeholder="tu-nombre-unico"
                class="flex-1 px-4 py-3 bg-transparent text-white focus:outline-none placeholder-gray-600"
              />
            </div>
            <p v-if="errors.slug" class="text-sm text-red-500 mt-1">{{ errors.slug }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Usa solo letras minúsculas, números, guiones y guiones bajos. Esta será tu URL pública.
            </p>
          </div>

          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Biografía (Opcional)</label>
            <textarea
              v-model="form.bio"
              maxlength="500"
              rows="4"
              placeholder="Cuéntales sobre ti, tu contenido, por qué deberían apoyarte..."
              class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600 resize-none"
              :class="{ 'border-red-500': errors.bio }"
            ></textarea>
            <p v-if="errors.bio" class="text-sm text-red-500 mt-1">{{ errors.bio }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ form.bio?.length || 0 }}/500 caracteres</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Avatar URL (Opcional)</label>
            <input
              v-model="form.avatar_url"
              type="url"
              placeholder="https://ejemplo.com/tu-avatar.jpg"
              class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
              :class="{ 'border-red-500': errors.avatar_url }"
            />
            <p v-if="errors.avatar_url" class="text-sm text-red-500 mt-1">{{ errors.avatar_url }}</p>
            <p class="text-xs text-gray-500 mt-2">
              Ingresa la URL a una imagen de perfil. Recomendamos una imagen cuadrada.
            </p>
          </div>

          <div class="bg-dark-bg border border-dark-border rounded-lg p-4">
            <p class="text-sm text-gray-300">
              <strong class="text-neon-cyan drop-shadow-[0_0_5px_rgba(0,243,255,0.8)]">💡 Tip:</strong> Puedes usar sitios como Gravatar, ImageShack o cualquier servicio de alojamiento de imágenes.
            </p>
          </div>

          <button
            type="submit"
            :disabled="isSubmitting"
            class="w-full bg-neon-cyan text-dark-bg font-black py-4 rounded-xl hover:bg-white hover:text-dark-bg hover:shadow-[0_0_20px_rgba(0,243,255,0.6)] disabled:bg-gray-700 disabled:text-gray-500 transition-all text-lg uppercase tracking-widest"
          >
            {{ isSubmitting ? 'CREANDO...' : 'CREAR MI PÁGINA' }}
          </button>
        </form>

        <div class="mt-8 pt-8 border-t border-dark-border">
          <h3 class="font-bold text-gray-100 mb-4 uppercase tracking-wide">¿Qué incluye tu página?</h3>
          <ul class="space-y-3 text-sm text-gray-400">
            <li class="flex items-center"><span class="text-neon-cyan mr-2 font-black">✓</span> URL pública personalizada</li>
            <li class="flex items-center"><span class="text-neon-magenta mr-2 font-black">✓</span> Perfil con avatar y biografía</li>
            <li class="flex items-center"><span class="text-neon-green mr-2 font-black">✓</span> Gestor de enlaces (tipo Linktree)</li>
            <li class="flex items-center"><span class="text-neon-cyan mr-2 font-black">✓</span> Recepción de apoyos monetarios</li>
            <li class="flex items-center"><span class="text-neon-magenta mr-2 font-black">✓</span> Dashboard para administrar apoyos</li>
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

