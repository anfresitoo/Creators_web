<template>
  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto">
      <!-- Mensaje flash global -->
      <div v-if="$page.props.flash?.success" class="mb-6 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
        {{ $page.props.flash.success }}
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow p-6 sticky top-4">
            <div class="text-center mb-6">
              <img
                v-if="creator.avatar_url"
                :src="creator.avatar_url"
                :alt="creatorName"
                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover"
              />
              <div v-else class="w-20 h-20 rounded-full mx-auto mb-4 bg-gray-300 flex items-center justify-center">
                <span class="text-2xl text-gray-600">{{ creatorName.charAt(0) }}</span>
              </div>
              <h2 class="text-xl font-bold text-gray-900">{{ creatorName }}</h2>
              <p class="text-sm text-gray-600">/@{{ creator.slug }}</p>
              <a
                :href="`/@${creator.slug}`"
                target="_blank"
                class="text-blue-600 hover:text-blue-700 text-sm mt-2 inline-block"
              >
                Ver página pública →
              </a>
            </div>

            <div class="border-t pt-6 space-y-3">
              <button
                @click="activeTab = 'profile'"
                :class="[
                  'w-full text-left px-4 py-2 rounded transition',
                  activeTab === 'profile'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                ]"
              >
                📝 Editar Perfil
              </button>
              <button
                @click="activeTab = 'links'"
                :class="[
                  'w-full text-left px-4 py-2 rounded transition',
                  activeTab === 'links'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                ]"
              >
                🔗 Mis Enlaces
              </button>
              <button
                @click="activeTab = 'supports'"
                :class="[
                  'w-full text-left px-4 py-2 rounded transition',
                  activeTab === 'supports'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                ]"
              >
                💚 Apoyos
              </button>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2">
          <!-- Profile Tab -->
          <div v-if="activeTab === 'profile'" class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Editar Perfil</h3>

              <!-- Mensaje de éxito del perfil -->
              <div v-if="profileSuccess" class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                {{ profileSuccess }}
              </div>

              <form @submit.prevent="updateProfile" class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nombre público</label>
                  <input
                    v-model="profileForm.display_name"
                    type="text"
                    maxlength="100"
                    placeholder="Tu nombre de creador (ej: Juan Gameplays)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': profileErrors.display_name }"
                  />
                  <p v-if="profileErrors.display_name" class="text-sm text-red-600 mt-1">{{ profileErrors.display_name }}</p>
                  <p class="text-xs text-gray-500 mt-1">Este nombre se mostrará en tu página pública. Si lo dejas vacío, se usará tu nombre de cuenta.</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Slug (URL)</label>
                  <div class="flex items-center">
                    <span class="text-gray-600">/@</span>
                    <input
                      v-model="profileForm.slug"
                      type="text"
                      required
                      pattern="[a-z0-9_-]+"
                      class="flex-1 ml-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      :class="{ 'border-red-500': profileErrors.slug }"
                      placeholder="tu-slug"
                    />
                  </div>
                  <p v-if="profileErrors.slug" class="text-sm text-red-600 mt-1">{{ profileErrors.slug }}</p>
                  <p class="text-xs text-gray-500 mt-1">Solo letras minúsculas, números, guiones y guiones bajos</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                  <textarea
                    v-model="profileForm.bio"
                    maxlength="500"
                    rows="4"
                    placeholder="Cuéntales sobre ti..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': profileErrors.bio }"
                  ></textarea>
                  <p v-if="profileErrors.bio" class="text-sm text-red-600 mt-1">{{ profileErrors.bio }}</p>
                  <p class="text-xs text-gray-500 mt-1">{{ profileForm.bio?.length || 0 }}/500 caracteres</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Avatar URL</label>
                  <input
                    v-model="profileForm.avatar_url"
                    type="url"
                    placeholder="https://ejemplo.com/avatar.jpg"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': profileErrors.avatar_url }"
                  />
                  <p v-if="profileErrors.avatar_url" class="text-sm text-red-600 mt-1">{{ profileErrors.avatar_url }}</p>
                  <p class="text-xs text-gray-500 mt-1">Ingresa una URL a una imagen</p>
                </div>

                <button
                  type="submit"
                  :disabled="isSubmittingProfile"
                  class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 disabled:bg-gray-400"
                >
                  {{ isSubmittingProfile ? 'Guardando...' : 'Guardar cambios' }}
                </button>
              </form>
            </div>
          </div>

          <!-- Links Tab -->
          <div v-if="activeTab === 'links'" class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Mis Enlaces</h3>

              <!-- Add Link Form -->
              <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="font-semibold text-gray-900 mb-3">Agregar nuevo enlace</h4>
                <form @submit.prevent="addLink" class="space-y-3">
                  <div>
                    <input
                      v-model="linkForm.title"
                      type="text"
                      required
                      maxlength="100"
                      placeholder="Título del enlace (ej: Mi YouTube)"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      :class="{ 'border-red-500': linkErrors.title }"
                    />
                    <p v-if="linkErrors.title" class="text-sm text-red-600 mt-1">{{ linkErrors.title }}</p>
                  </div>
                  <div>
                    <input
                      v-model="linkForm.url"
                      type="url"
                      required
                      placeholder="URL (ej: https://youtube.com/...)"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      :class="{ 'border-red-500': linkErrors.url }"
                    />
                    <p v-if="linkErrors.url" class="text-sm text-red-600 mt-1">{{ linkErrors.url }}</p>
                  </div>
                  <button
                    type="submit"
                    :disabled="isSubmittingLink"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 disabled:bg-gray-400"
                  >
                    {{ isSubmittingLink ? 'Agregando...' : 'Agregar enlace' }}
                  </button>
                </form>
              </div>

              <!-- Links List -->
              <div v-if="links.length > 0" class="space-y-3">
                <div
                  v-for="(link, index) in links"
                  :key="link.id"
                  class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100"
                >
                  <div class="flex-1">
                    <p class="font-semibold text-gray-900">{{ link.title }}</p>
                    <p class="text-sm text-gray-600 truncate">{{ link.url }}</p>
                  </div>
                  <button
                    @click="deleteLink(link.id)"
                    class="ml-4 text-red-600 hover:text-red-700 font-semibold"
                  >
                    Eliminar
                  </button>
                </div>
              </div>
              <div v-else class="text-center text-gray-500 py-8">
                <p>No tienes enlaces aún. ¡Agrega uno para comenzar!</p>
              </div>
            </div>
          </div>

          <!-- Supports Tab -->
          <div v-if="activeTab === 'supports'" class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Apoyos Recibidos</h3>

              <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg">
                  <p class="text-sm text-blue-600 font-medium">Total de apoyos</p>
                  <p class="text-3xl font-bold text-blue-900">{{ totalSupports }}</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg">
                  <p class="text-sm text-green-600 font-medium">Monto recaudado</p>
                  <p class="text-3xl font-bold text-green-900">CLP {{ formatAmount(totalAmount) }}</p>
                </div>
              </div>

              <div v-if="supports.length > 0" class="space-y-3 max-h-96 overflow-y-auto">
                <div
                  v-for="support in supports"
                  :key="support.id"
                  class="p-4 border border-gray-200 rounded-lg"
                >
                  <div class="flex justify-between items-start mb-2">
                    <span class="font-semibold text-gray-900">{{ support.supporter_name }}</span>
                    <span class="text-green-600 font-bold">CLP {{ formatAmount(support.amount) }}</span>
                  </div>
                  <p v-if="support.message" class="text-gray-600 text-sm">{{ support.message }}</p>
                  <p class="text-xs text-gray-400 mt-2">{{ formatDate(support.created_at) }}</p>
                </div>
              </div>
              <div v-else class="text-center text-gray-500 py-8">
                <p>Aún no has recibido apoyos. ¡Comparte tu página pública!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  creator: Object,
  links: Array,
  supports: Array,
  total_supports: Number,
  total_amount: Number,
});

const page = usePage();
const activeTab = ref('profile');
const isSubmittingProfile = ref(false);
const isSubmittingLink = ref(false);
const profileSuccess = ref('');
const profileErrors = reactive({});
const linkErrors = reactive({});

const creatorName = computed(() => props.creator.display_name || page.props.auth.user.name);

const profileForm = reactive({
  slug: props.creator.slug,
  display_name: props.creator.display_name || '',
  bio: props.creator.bio || '',
  avatar_url: props.creator.avatar_url || '',
});

const linkForm = reactive({
  title: '',
  url: '',
});

const links = ref(props.links || []);
const supports = ref(props.supports || []);
const totalSupports = ref(props.total_supports || 0);
const totalAmount = ref(props.total_amount || 0);

const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content;

const updateProfile = () => {
  isSubmittingProfile.value = true;
  profileSuccess.value = '';

  // Limpiar errores previos
  Object.keys(profileErrors).forEach(key => delete profileErrors[key]);

  router.put('/creator/update', profileForm, {
    onSuccess: () => {
      profileSuccess.value = '¡Perfil actualizado correctamente!';
    },
    onError: (validationErrors) => {
      Object.assign(profileErrors, validationErrors);
    },
    onFinish: () => {
      isSubmittingProfile.value = false;
    },
  });
};

const addLink = async () => {
  isSubmittingLink.value = true;

  // Limpiar errores previos
  Object.keys(linkErrors).forEach(key => delete linkErrors[key]);

  try {
    const response = await fetch('/api/creator-links', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken(),
      },
      body: JSON.stringify(linkForm),
    });

    if (response.ok) {
      const data = await response.json();
      links.value.push(data.link);
      linkForm.title = '';
      linkForm.url = '';
    } else if (response.status === 422) {
      const data = await response.json();
      if (data.errors) {
        Object.assign(linkErrors, data.errors);
      }
    }
  } catch (error) {
    console.error('Error:', error);
  } finally {
    isSubmittingLink.value = false;
  }
};

const deleteLink = async (linkId) => {
  if (!confirm('¿Estás seguro?')) return;

  try {
    const response = await fetch(`/api/creator-links/${linkId}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken(),
      },
    });

    if (response.ok) {
      links.value = links.value.filter(l => l.id !== linkId);
    }
  } catch (error) {
    console.error('Error:', error);
  }
};

const formatAmount = (amount) => {
  return new Intl.NumberFormat('es-CL').format(Math.round(amount));
};

const formatDate = (date) => {
  return new Intl.DateTimeFormat('es-CL', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  }).format(new Date(date));
};
</script>
