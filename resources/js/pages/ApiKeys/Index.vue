<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  apiKeys: Array,
})

const form = useForm({
  name: '',
})

const createKey = () => {
  form.post(route('api-keys.store'), {
    preserveScroll: true,
  })
}

const deleteKey = (id) => {
  router.delete(route('api-keys.destroy', id))
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Mes clés API</h1>

    <form @submit.prevent="createKey" class="mb-6">
      <input
        v-model="form.name"
        type="text"
        placeholder="Nom de la clé"
        class="border p-2 mr-2 rounded"
      />
      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded"
      >
        Générer
      </button>
    </form>

    <ul class="space-y-2">
      <li
        v-for="key in apiKeys"
        :key="key.id"
        class="flex justify-between items-center border p-3 rounded"
      >
        <div>
          <div class="font-medium">{{ key.name }}</div>
          <div class="text-gray-600 text-sm">{{ key.key }}</div>
        </div>
        <button
          @click="deleteKey(key.id)"
          class="text-red-600 hover:underline"
        >
          Supprimer
        </button>
      </li>
    </ul>
  </div>
</template>
