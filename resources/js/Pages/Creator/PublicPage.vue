<template>
  <PublicLayout>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <!-- Creator Header -->
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-12 sm:px-8">
        <div class="flex flex-col items-center text-center">
          <img
            v-if="creator.avatar_url"
            :src="creator.avatar_url"
            :alt="creator.name"
            class="w-24 h-24 rounded-full border-4 border-white shadow-lg mb-4 object-cover"
          />
          <div v-else class="w-24 h-24 rounded-full border-4 border-white shadow-lg mb-4 bg-gray-300 flex items-center justify-center">
            <span class="text-2xl text-gray-600">{{ creator.name.charAt(0) }}</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">{{ creator.name }}</h1>
          <p v-if="creator.bio" class="text-blue-100 text-lg max-w-2xl">{{ creator.bio }}</p>
        </div>
      </div>

      <!-- Links Section -->
      <div v-if="creator.links.length > 0" class="px-6 py-8 sm:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Enlaces</h2>
        <div class="space-y-3">
          <a
            v-for="link in creator.links"
            :key="link.id"
            :href="link.url"
            target="_blank"
            rel="noopener noreferrer"
            class="block p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition text-center"
          >
            <span class="font-semibold text-gray-900">{{ link.title }}</span>
            <p class="text-sm text-gray-500 mt-1">{{ truncateUrl(link.url) }}</p>
          </a>
        </div>
      </div>

      <!-- Support Button -->
      <div class="px-6 py-6 sm:px-8 border-t border-gray-200">
        <button
          @click="openSupportModal"
          class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold py-3 px-4 rounded-lg hover:from-green-600 hover:to-emerald-700 transition text-lg"
        >
          💚 Apoyar al creador
        </button>
      </div>

      <!-- Recent Supports -->
      <div v-if="creator.supports.length > 0" class="px-6 py-8 sm:px-8 border-t border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Apoyos recientes</h2>
        <div class="space-y-4 max-h-96 overflow-y-auto">
          <div
            v-for="support in creator.supports.slice(0, 10)"
            :key="support.id"
            class="bg-gray-50 p-4 rounded-lg"
          >
            <div class="flex justify-between items-start mb-2">
              <span class="font-semibold text-gray-900">{{ support.supporter_name }}</span>
              <span class="text-green-600 font-bold">CLP {{ formatAmount(support.amount) }}</span>
            </div>
            <p v-if="support.message" class="text-gray-600 text-sm">{{ support.message }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ formatDate(support.created_at) }}</p>
          </div>
        </div>

        <!-- Stats -->
        <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-2 gap-4">
          <div class="text-center">
            <p class="text-3xl font-bold text-blue-600">{{ creator.total_supports }}</p>
            <p class="text-gray-600">{{ creator.total_supports === 1 ? 'Apoyo' : 'Apoyos' }} recibidos</p>
          </div>
          <div class="text-center">
            <p class="text-3xl font-bold text-green-600">CLP {{ formatAmount(creator.total_amount) }}</p>
            <p class="text-gray-600">Total recaudado</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Support Modal -->
    <Teleport to="body">
      <transition name="fade">
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <transition name="scale">
            <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
              <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Apoyar a {{ creator.name }}</h2>
                <button @click="closeSupportModal" class="text-gray-500 hover:text-gray-700 text-2xl">×</button>
              </div>

              <form @submit.prevent="submitSupport" class="px-6 py-6 space-y-4">
                <!-- Error general -->
                <div v-if="formGeneralError" class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                  {{ formGeneralError }}
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Tu nombre</label>
                  <input
                    v-model="form.supporter_name"
                    type="text"
                    required
                    maxlength="100"
                    placeholder="Tu nombre o apodo"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': formErrors.supporter_name }"
                  />
                  <p v-if="formErrors.supporter_name" class="text-sm text-red-600 mt-1">{{ formErrors.supporter_name }}</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Mensaje (opcional)</label>
                  <textarea
                    v-model="form.message"
                    maxlength="1000"
                    placeholder="¿Qué te inspira de este creador?"
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': formErrors.message }"
                  ></textarea>
                  <p v-if="formErrors.message" class="text-sm text-red-600 mt-1">{{ formErrors.message }}</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Monto (CLP 1-100)</label>
                  <input
                    v-model.number="form.amount"
                    type="number"
                    min="1"
                    max="100"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': formErrors.amount }"
                  />
                  <p v-if="formErrors.amount" class="text-sm text-red-600 mt-1">{{ formErrors.amount }}</p>
                </div>

                <div class="bg-blue-50 p-3 rounded-lg">
                  <p class="text-sm text-blue-900">Total: <span class="font-bold">CLP {{ form.amount }}</span></p>
                </div>

                <div class="flex space-x-3 pt-4">
                  <button
                    type="button"
                    @click="closeSupportModal"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
                  >
                    Cancelar
                  </button>
                  <button
                    type="submit"
                    :disabled="isSubmitting"
                    class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:bg-gray-400"
                  >
                    {{ isSubmitting ? 'Enviando...' : 'Enviar apoyo' }}
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
