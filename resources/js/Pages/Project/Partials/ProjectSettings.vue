<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  project: Object
});

const emit = defineEmits(['select', 'create-page']);

// funkce pro výběr projektu
function selectProject() {
  emit('select', { type: 'project', data: props.project });
}

// funkce pro vytvoření nové stránky
function createPage() {
  emit('create-page', props.project.id);
}
</script>

<template>
  <a href="#" @click.prevent="selectProject"
    class="relative flex justify-between align-center w-full items-center px-3 py-2 bg-white rounded-md font-bold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
    {{ project.name }}

    <a href="#" @click.prevent="createPage" class="group transition duration-150 ease-in-out hover:bg-gray-300 rounded-md">
      <svg class=" h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12H18M12 6v12" />
      </svg>
      <p class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover:opacity-100">Add page inside</p>
    </a>

  </a>
</template>