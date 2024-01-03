<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    pages: Array
});

const emit = defineEmits(['select', 'createSubPage']);

// funkce pro výběr stránky
function selectPage(page) {
    emit('select', { type: 'page', data: page });
}
// funkce pro vytvoření nové stránky
function createSubPage(parentPageId) {
    emit('createSubPage', parentPageId);
}
</script>

<template>
    <ul class="flex flex-col gap-1">
        <li v-for="page in pages" :key="page.id">
            <a href="#" @click.prevent="selectPage(page)"
                class="flex relative justify-between align-center w-full items-center px-3 py-2 bg-white rounded-md text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ page.name }}

                <a href="#" @click.prevent="createSubPage(page.id)" class="group transition duration-150 ease-in-out hover:bg-gray-300 rounded-md">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12H18M12 6v12" />
                    </svg>
                    <p
                        class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover:opacity-100">
                        Add page inside</p>
                </a>
            </a>
        </li>
    </ul>
</template>