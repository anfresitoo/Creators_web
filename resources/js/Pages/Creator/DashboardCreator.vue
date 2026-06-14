<template>
  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto">
      <!-- Mensaje flash global -->
      <div v-if="$page.props.flash?.success" class="mb-6 p-3 bg-green-900/30 border border-green-500/50 rounded-lg text-neon-green text-sm">
        {{ $page.props.flash.success }}
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-dark-panel border border-neon-cyan/30 rounded-xl shadow-[0_0_15px_rgba(0,243,255,0.1)] p-6 sticky top-4">
            <div class="text-center mb-6">
              <img
                v-if="creator.avatar_url"
                :src="creator.avatar_url"
                :alt="creatorName"
                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover border border-neon-cyan shadow-[0_0_10px_rgba(0,243,255,0.4)]"
              />
              <div v-else class="w-20 h-20 rounded-full mx-auto mb-4 bg-dark-bg flex items-center justify-center border border-neon-cyan shadow-[0_0_10px_rgba(0,243,255,0.4)]">
                <span class="text-2xl text-neon-cyan font-black">{{ creatorName.charAt(0) }}</span>
              </div>
              <h2 class="text-xl font-bold text-gray-100 uppercase tracking-wide">{{ creatorName }}</h2>
              <p class="text-sm text-neon-cyan mt-1">/@{{ creator.slug }}</p>
              <a
                :href="`/@${creator.slug}`"
                target="_blank"
                class="text-gray-400 hover:text-neon-magenta text-sm mt-3 inline-block transition-colors"
              >
                Ver página pública →
              </a>
            </div>

            <div class="border-t border-dark-border pt-6 space-y-3">
              <button
                @click="activeTab = 'profile'"
                :class="[
                  'w-full text-left px-4 py-3 rounded-lg transition-all font-bold tracking-wide',
                  activeTab === 'profile'
                    ? 'bg-neon-cyan text-dark-bg shadow-[0_0_10px_rgba(0,243,255,0.4)]'
                    : 'bg-dark-bg text-gray-400 border border-dark-border hover:border-neon-cyan hover:text-neon-cyan',
                ]"
              >
                📝 Editar Perfil
              </button>
              <button
                @click="activeTab = 'links'"
                :class="[
                  'w-full text-left px-4 py-3 rounded-lg transition-all font-bold tracking-wide',
                  activeTab === 'links'
                    ? 'bg-neon-magenta text-white shadow-[0_0_10px_rgba(255,0,255,0.4)]'
                    : 'bg-dark-bg text-gray-400 border border-dark-border hover:border-neon-magenta hover:text-neon-magenta',
                ]"
              >
                🔗 Mis Enlaces
              </button>
              <button
                @click="activeTab = 'supports'"
                :class="[
                  'w-full text-left px-4 py-3 rounded-lg transition-all font-bold tracking-wide',
                  activeTab === 'supports'
                    ? 'bg-neon-green text-dark-bg shadow-[0_0_10px_rgba(57,255,20,0.4)]'
                    : 'bg-dark-bg text-gray-400 border border-dark-border hover:border-neon-green hover:text-neon-green',
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
          <div v-if="activeTab === 'profile'" class="bg-dark-panel border border-neon-cyan/30 rounded-xl shadow-[0_0_15px_rgba(0,243,255,0.1)] p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-black text-gray-100 mb-6 uppercase tracking-wide">Editar Perfil</h3>

              <!-- Mensaje de éxito del perfil -->
              <div v-if="profileSuccess" class="mb-6 p-3 bg-green-900/30 border border-green-500/50 rounded-lg text-neon-green text-sm">
                {{ profileSuccess }}
              </div>

              <form @submit.prevent="updateProfile" class="space-y-5">
                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Nombre público</label>
                  <input
                    v-model="profileForm.display_name"
                    type="text"
                    maxlength="100"
                    placeholder="Tu nombre de creador"
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
                    :class="{ 'border-red-500': profileErrors.display_name }"
                  />
                  <p v-if="profileErrors.display_name" class="text-sm text-red-500 mt-1">{{ profileErrors.display_name }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Slug (URL)</label>
                  <div class="flex items-center border border-dark-border bg-dark-bg rounded-lg overflow-hidden focus-within:border-neon-cyan focus-within:ring-1 focus-within:ring-neon-cyan" :class="{ 'border-red-500': profileErrors.slug }">
                    <span class="px-4 py-3 bg-dark-panel text-gray-500 border-r border-dark-border font-bold">/@</span>
                    <input
                      v-model="profileForm.slug"
                      type="text"
                      required
                      pattern="[a-z0-9_-]+"
                      class="flex-1 px-4 py-3 bg-transparent text-white focus:outline-none placeholder-gray-600"
                      placeholder="tu-slug"
                    />
                  </div>
                  <p v-if="profileErrors.slug" class="text-sm text-red-500 mt-1">{{ profileErrors.slug }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Bio</label>
                  <textarea
                    v-model="profileForm.bio"
                    maxlength="500"
                    rows="4"
                    placeholder="Cuéntales sobre ti..."
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600 resize-none"
                    :class="{ 'border-red-500': profileErrors.bio }"
                  ></textarea>
                  <p v-if="profileErrors.bio" class="text-sm text-red-500 mt-1">{{ profileErrors.bio }}</p>
                  <p class="text-xs text-gray-500 mt-1">{{ profileForm.bio?.length || 0 }}/500 caracteres</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Avatar URL</label>
                  <input
                    v-model="profileForm.avatar_url"
                    type="url"
                    placeholder="https://ejemplo.com/avatar.jpg"
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
                    :class="{ 'border-red-500': profileErrors.avatar_url }"
                  />
                  <p v-if="profileErrors.avatar_url" class="text-sm text-red-500 mt-1">{{ profileErrors.avatar_url }}</p>
                </div>

                <button
                  type="submit"
                  :disabled="isSubmittingProfile"
                  class="w-full bg-neon-cyan text-dark-bg font-black py-4 rounded-xl hover:bg-white hover:text-dark-bg hover:shadow-[0_0_20px_rgba(0,243,255,0.6)] disabled:bg-gray-700 disabled:text-gray-500 transition-all text-lg uppercase tracking-widest mt-4"
                >
                  {{ isSubmittingProfile ? 'GUARDANDO...' : 'GUARDAR CAMBIOS' }}
                </button>
              </form>
            </div>
          </div>

          <!-- Links Tab -->
          <div v-if="activeTab === 'links'" class="bg-dark-panel border border-neon-magenta/30 rounded-xl shadow-[0_0_15px_rgba(255,0,255,0.1)] p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-black text-gray-100 mb-6 uppercase tracking-wide">Mis Enlaces</h3>

              <!-- Add Link Form -->
              <div class="mb-8 p-6 bg-dark-bg border border-dark-border rounded-xl">
                <h4 class="font-bold text-gray-200 mb-4 uppercase tracking-wide text-sm">Agregar nuevo enlace</h4>
                <form @submit.prevent="addLink" class="space-y-4">
                  <div>
                    <input
                      v-model="linkForm.title"
                      type="text"
                      required
                      maxlength="100"
                      placeholder="Título del enlace (ej: Mi YouTube)"
                      class="w-full px-4 py-3 bg-dark-panel border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-magenta focus:ring-1 focus:ring-neon-magenta placeholder-gray-600"
                      :class="{ 'border-red-500': linkErrors.title }"
                    />
                    <p v-if="linkErrors.title" class="text-sm text-red-500 mt-1">{{ linkErrors.title }}</p>
                  </div>
                  <div>
                    <input
                      v-model="linkForm.url"
                      type="url"
                      required
                      placeholder="URL (ej: https://youtube.com/...)"
                      class="w-full px-4 py-3 bg-dark-panel border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-magenta focus:ring-1 focus:ring-neon-magenta placeholder-gray-600"
                      :class="{ 'border-red-500': linkErrors.url }"
                    />
                    <p v-if="linkErrors.url" class="text-sm text-red-500 mt-1">{{ linkErrors.url }}</p>
                  </div>
                  <button
                    type="submit"
                    :disabled="isSubmittingLink"
                    class="w-full bg-neon-magenta text-white font-black py-3 rounded-lg hover:bg-white hover:text-dark-bg hover:shadow-[0_0_15px_rgba(255,0,255,0.6)] disabled:bg-gray-700 disabled:text-gray-500 transition-all uppercase tracking-widest mt-2"
                  >
                    {{ isSubmittingLink ? 'AGREGANDO...' : 'AGREGAR ENLACE' }}
                  </button>
                </form>
              </div>

              <!-- Links List -->
              <div v-if="links.length > 0" class="space-y-3">
                <div
                  v-for="(link, index) in links"
                  :key="link.id"
                  class="flex items-center justify-between p-4 bg-dark-bg border border-dark-border rounded-lg hover:border-neon-magenta hover:shadow-[0_0_10px_rgba(255,0,255,0.2)] transition-all"
                >
                  <div class="flex-1 overflow-hidden pr-4">
                    <p class="font-bold text-gray-200 uppercase tracking-wide">{{ link.title }}</p>
                    <p class="text-sm text-gray-500 truncate">{{ link.url }}</p>
                  </div>
                  <button
                    @click="deleteLink(link.id)"
                    class="text-red-500 hover:text-red-400 hover:drop-shadow-[0_0_5px_rgba(239,68,68,0.8)] font-bold transition-all uppercase text-sm tracking-wider"
                  >
                    ELIMINAR
                  </button>
                </div>
              </div>
              <div v-else class="text-center text-gray-500 py-8">
                <p>No tienes enlaces aún. ¡Agrega uno para comenzar!</p>
              </div>
            </div>
          </div>

          <!-- Supports Tab -->
          <div v-if="activeTab === 'supports'" class="bg-dark-panel border border-neon-green/30 rounded-xl shadow-[0_0_15px_rgba(57,255,20,0.1)] p-6 space-y-6">
            <div>
              <h3 class="text-2xl font-black text-gray-100 mb-6 uppercase tracking-wide">Apoyos Recibidos</h3>

              <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-dark-bg border border-neon-cyan/50 p-6 rounded-xl relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-16 h-16 bg-neon-cyan opacity-10 rounded-full blur-xl -mr-4 -mt-4"></div>
                  <p class="text-sm text-neon-cyan font-bold uppercase tracking-wide">Total de apoyos</p>
                  <p class="text-4xl font-black text-gray-100 mt-2">{{ totalSupports }}</p>
                </div>
                <div class="bg-dark-bg border border-neon-green/50 p-6 rounded-xl relative overflow-hidden">
                  <div class="absolute top-0 right-0 w-16 h-16 bg-neon-green opacity-10 rounded-full blur-xl -mr-4 -mt-4"></div>
                  <p class="text-sm text-neon-green font-bold uppercase tracking-wide">Monto recaudado</p>
                  <p class="text-3xl font-black text-gray-100 mt-2 drop-shadow-[0_0_5px_rgba(57,255,20,0.3)]">CLP {{ formatAmount(totalAmount) }}</p>
                </div>
              </div>

              <div v-if="supports.length > 0" class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                <div
                  v-for="support in supports"
                  :key="support.id"
                  class="p-5 bg-dark-bg border border-dark-border rounded-xl hover:border-neon-green/50 transition-colors"
                >
                  <div class="flex justify-between items-start mb-3">
                    <span class="font-bold text-gray-200">{{ support.supporter_name }}</span>
                    <span class="text-neon-green font-black tracking-wider text-lg">CLP {{ formatAmount(support.amount) }}</span>
                  </div>
                  <p v-if="support.message" class="text-gray-400 text-sm italic mb-2">"{{ support.message }}"</p>
                  <p class="text-xs text-gray-600 font-mono">{{ formatDate(support.created_at) }}</p>
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
