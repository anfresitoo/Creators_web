<template>
  <PublicLayout>
    <div class="bg-dark-panel rounded-xl border border-neon-cyan/30 shadow-[0_0_30px_rgba(0,243,255,0.1)] overflow-hidden">
      <!-- Creator Header -->
      <div class="bg-dark-bg border-b border-neon-cyan/50 px-6 py-12 sm:px-8 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-neon-cyan opacity-5 blur-[100px] pointer-events-none"></div>
        <div class="flex flex-col items-center text-center relative z-10">
          <img
            v-if="creator.avatar_url"
            :src="creator.avatar_url"
            :alt="creator.name"
            class="w-24 h-24 rounded-full border-2 border-neon-cyan shadow-[0_0_15px_rgba(0,243,255,0.6)] mb-4 object-cover"
          />
          <div v-else class="w-24 h-24 rounded-full border-2 border-neon-cyan shadow-[0_0_15px_rgba(0,243,255,0.6)] mb-4 bg-dark-panel flex items-center justify-center">
            <span class="text-2xl text-neon-cyan font-black">{{ creator.name.charAt(0) }}</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-black text-white mb-2 tracking-wide uppercase">{{ creator.name }}</h1>
          <p v-if="creator.bio" class="text-gray-400 text-lg max-w-2xl">{{ creator.bio }}</p>
        </div>
      </div>

      <!-- Links Section -->
      <div v-if="creator.links.length > 0" class="px-6 py-8 sm:px-8 relative z-10">
        <h2 class="text-2xl font-bold text-neon-cyan mb-6 uppercase tracking-wider">Enlaces</h2>
        <div class="space-y-4">
          <a
            v-for="link in creator.links"
            :key="link.id"
            :href="link.url"
            target="_blank"
            rel="noopener noreferrer"
            class="block p-4 border border-dark-border bg-dark-bg rounded-lg hover:border-neon-cyan hover:shadow-[0_0_15px_rgba(0,243,255,0.3)] transition-all text-center group"
          >
            <span class="font-bold text-gray-200 group-hover:text-neon-cyan transition-colors uppercase tracking-wide">{{ link.title }}</span>
            <p class="text-sm text-gray-500 mt-1">{{ truncateUrl(link.url) }}</p>
          </a>
        </div>
      </div>

      <!-- Support Button -->
      <div class="px-6 py-8 sm:px-8 border-t border-dark-border relative z-10">
        <button
          @click="openSupportModal"
          class="w-full bg-transparent border-2 border-neon-green text-neon-green font-black py-4 px-4 rounded-xl hover:bg-neon-green hover:text-dark-bg hover:shadow-[0_0_25px_rgba(57,255,20,0.6)] transition-all text-lg uppercase tracking-widest"
        >
          [ Apoyar al creador ]
        </button>
      </div>

      <!-- Recent Supports -->
      <div v-if="creator.supports.length > 0" class="px-6 py-8 sm:px-8 border-t border-dark-border relative z-10">
        <h2 class="text-2xl font-bold text-neon-magenta mb-6 uppercase tracking-wider">Apoyos recientes</h2>
        <div class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
          <div
            v-for="support in creator.supports.slice(0, 10)"
            :key="support.id"
            class="bg-dark-bg border border-dark-border p-4 rounded-lg"
          >
            <div class="flex justify-between items-start mb-2">
              <span class="font-bold text-gray-200">{{ support.supporter_name }}</span>
              <span class="text-neon-green font-black tracking-wide">CLP {{ formatAmount(support.amount) }}</span>
            </div>
            <p v-if="support.message" class="text-gray-400 text-sm italic">"{{ support.message }}"</p>
            <p class="text-xs text-gray-600 mt-2 font-mono">{{ formatDate(support.created_at) }}</p>
          </div>
        </div>

        <!-- Stats -->
        <div class="mt-8 pt-8 border-t border-dark-border grid grid-cols-2 gap-4">
          <div class="text-center">
            <p class="text-3xl font-black text-neon-cyan drop-shadow-[0_0_8px_rgba(0,243,255,0.5)]">{{ creator.total_supports }}</p>
            <p class="text-gray-500 text-sm uppercase tracking-wide mt-1">{{ creator.total_supports === 1 ? 'Apoyo' : 'Apoyos' }} recibidos</p>
          </div>
          <div class="text-center">
            <p class="text-3xl font-black text-neon-green drop-shadow-[0_0_8px_rgba(57,255,20,0.5)]">CLP {{ formatAmount(creator.total_amount) }}</p>
            <p class="text-gray-500 text-sm uppercase tracking-wide mt-1">Total recaudado</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Support Modal -->
    <Teleport to="body">
      <transition name="fade">
        <div v-if="showModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 z-50">
          <transition name="scale">
            <div class="bg-dark-panel border border-neon-cyan/50 rounded-xl shadow-[0_0_40px_rgba(0,243,255,0.15)] max-w-md w-full">
              <div class="px-6 py-4 border-b border-dark-border flex justify-between items-center bg-dark-bg/50 rounded-t-xl">
                <h2 class="text-xl font-bold text-gray-100 uppercase tracking-wide">Apoyar a <span class="text-neon-cyan">{{ creator.name }}</span></h2>
                <button @click="closeSupportModal" class="text-gray-400 hover:text-neon-magenta hover:drop-shadow-[0_0_5px_rgba(255,0,255,0.8)] text-2xl transition-all">×</button>
              </div>

              <form @submit.prevent="submitSupport" class="px-6 py-6 space-y-5">
                <!-- Error general -->
                <div v-if="formGeneralError" class="p-3 bg-red-900/30 border border-red-500/50 rounded-lg text-red-400 text-sm">
                  {{ formGeneralError }}
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Tu nombre</label>
                  <input
                    v-model="form.supporter_name"
                    type="text"
                    required
                    maxlength="100"
                    placeholder="Tu nombre o apodo"
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600"
                    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': formErrors.supporter_name }"
                  />
                  <p v-if="formErrors.supporter_name" class="text-sm text-red-500 mt-1">{{ formErrors.supporter_name }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Mensaje (opcional)</label>
                  <textarea
                    v-model="form.message"
                    maxlength="1000"
                    placeholder="¿Qué te inspira de este creador?"
                    rows="3"
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan placeholder-gray-600 resize-none"
                    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': formErrors.message }"
                  ></textarea>
                  <p v-if="formErrors.message" class="text-sm text-red-500 mt-1">{{ formErrors.message }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Monto (CLP 1-100)</label>
                  <input
                    v-model.number="form.amount"
                    type="number"
                    min="1"
                    max="100"
                    required
                    class="w-full px-4 py-3 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan"
                    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': formErrors.amount }"
                  />
                  <p v-if="formErrors.amount" class="text-sm text-red-500 mt-1">{{ formErrors.amount }}</p>
                </div>

                <div class="bg-dark-bg border border-dark-border p-4 rounded-lg flex justify-between items-center">
                  <span class="text-sm text-gray-400 uppercase tracking-wide">Total a enviar:</span>
                  <span class="font-black text-neon-green text-xl tracking-wider drop-shadow-[0_0_5px_rgba(57,255,20,0.5)]">CLP {{ form.amount }}</span>
                </div>

                <div class="flex space-x-3 pt-2">
                  <button
                    type="button"
                    @click="closeSupportModal"
                    class="flex-1 px-4 py-3 border border-dark-border rounded-lg text-gray-300 hover:bg-dark-border hover:text-white transition-colors uppercase tracking-wide text-sm font-bold"
                  >
                    Cancelar
                  </button>
                  <button
                    type="submit"
                    :disabled="isSubmitting"
                    class="flex-1 px-4 py-3 bg-transparent border-2 border-neon-green text-neon-green rounded-lg hover:bg-neon-green hover:text-dark-bg hover:shadow-[0_0_15px_rgba(57,255,20,0.6)] transition-all disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-wide text-sm font-black"
                  >
                    {{ isSubmitting ? 'ENVIANDO...' : 'ENVIAR APOYO' }}
                  </button>
                </div>
              </form>
            </div>
          </transition>
        </div>
      </transition>
    </Teleport>

    <!-- Toast notification -->
    <Teleport to="body">
      <transition name="slide">
        <div
          v-if="showToast"
          :class="[
            'fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white',
            toastType === 'success' ? 'bg-green-500' : 'bg-red-500',
          ]"
        >
          {{ toastMessage }}
        </div>
      </transition>
    </Teleport>
  </PublicLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const props = defineProps({
  creator: Object,
});

const showModal = ref(false);
const isSubmitting = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');
const formGeneralError = ref('');
const formErrors = reactive({});

const form = reactive({
  supporter_name: '',
  message: '',
  amount: 10,
});

const openSupportModal = () => {
  showModal.value = true;
};

const closeSupportModal = () => {
  showModal.value = false;
  formGeneralError.value = '';
  Object.keys(formErrors).forEach(key => delete formErrors[key]);
  form.supporter_name = '';
  form.message = '';
  form.amount = 10;
};

const submitSupport = async () => {
  isSubmitting.value = true;
  formGeneralError.value = '';
  Object.keys(formErrors).forEach(key => delete formErrors[key]);

  try {
    const response = await fetch('/api/supports', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
      },
      body: JSON.stringify({
        ...form,
        creator_id: props.creator.id,
      }),
    });

    if (response.ok) {
      toastType.value = 'success';
      toastMessage.value = '¡Gracias por tu apoyo! 💚';
      showToast.value = true;
      closeSupportModal();
      setTimeout(() => {
        showToast.value = false;
        location.reload();
      }, 2000);
    } else if (response.status === 422) {
      const data = await response.json();
      if (data.errors) {
        Object.entries(data.errors).forEach(([key, value]) => {
          formErrors[key] = Array.isArray(value) ? value[0] : value;
        });
      }
    } else {
      formGeneralError.value = 'Ocurrió un error al enviar el apoyo. Inténtalo de nuevo.';
    }
  } catch (error) {
    console.error('Error:', error);
    toastType.value = 'error';
    toastMessage.value = 'Error de conexión al enviar el apoyo';
    showToast.value = true;
    setTimeout(() => {
      showToast.value = false;
    }, 3000);
  } finally {
    isSubmitting.value = false;
  }
};

const formatAmount = (amount) => {
  return new Intl.NumberFormat('es-CL').format(amount);
};

const formatDate = (date) => {
  return new Intl.DateTimeFormat('es-CL', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  }).format(new Date(date));
};

const truncateUrl = (url) => {
  return url.length > 40 ? url.substring(0, 40) + '...' : url;
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.scale-enter-active,
.scale-leave-active {
  transition: transform 0.3s;
}

.scale-enter-from,
.scale-leave-to {
  transform: scale(0.9);
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}
</style>
