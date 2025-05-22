<template>
  <div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Créer une clé API</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1 font-medium">Nom de la clé</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full border rounded px-3 py-2"
          placeholder="Nom pour identifier la clé"
        />
        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">
          {{ form.errors.name }}
        </p>
      </div>

      <div class="flex justify-between mt-6">
        <Link href="/api-keys" class="text-gray-600 hover:underline">
          Annuler
        </Link>
        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Créer la clé
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link, usePage } from '@inertiajs/vue3'

const form = useForm({
  name: '',
})

function submit() {
  form.post('/api-keys')
}
</script>
