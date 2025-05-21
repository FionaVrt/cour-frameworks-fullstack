<template>

  <Head title="Playlists" />

  <MusicLayout>
    <template #title>
      Ajouter une playlist
    </template>

    <template #action>
      <Link :href="route('playlists.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-">
      Liste des playlists
      </Link>
    </template>

    <template #content>
      <form @submit.prevent="send">
        <!-- Title -->
        <div class="mb-3">
          <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
          <input v-model="form.title" type="text" name="title" id="title"
            class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-2"
            :class="{ 'border-red-500': form.errors.title }">
          <div class="text-red-500 text-xs italic">{{ form.errors.title }}</div>
        </div>

        <label for="tracks" class="block text-gray-700 text-sm font-bold mb-2">Musiques</label>
        <div v-for="track in tracks" :key="track.uuid">
          <input v-model="form.tracks" type="checkbox" name="tracks" :value="track.uuid" :id="track.uuid">
          <label :for="track.uuid">{{ track.title }}</label>
        </div>

        <input type="submit" value="Créer la musique"
          class="text-white font-bold rounded py-2 px-4 bg-blue-500 hover:bg-blue-700">
      </form>
    </template>
  </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  name: 'Index',
  components: {
    Head,
    MusicLayout,
    Link,
  },
  props: {
    tracks: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        title: '',
        tracks: [],
      })
    }
  },
  methods: {
    send() {
      this.form.post(route('playlists.store'));
    }
  }
}
</script>
