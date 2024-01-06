<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    subpages: Object,
});

const emit = defineEmits(['select', 'create-sub-page']);

function selectPage(page) {
    emit('select', page);
}

function createSubPage(parentPageId) {
    emit('create-sub-page', parentPageId);
}

</script>

<template>
        <ul v-show="subpages.open" class="flex pl-6 flex-col gap-1">
        <li v-for="page in subpages.subpages" :key="page.id">


            <a @click.prevent="selectPage(page)"
                class="flex cursor-pointer relative justify-between align-center w-full items-center px-3 py-2 bg-white rounded-md text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">
                
                <div class="flex gap-1">

                    <a @click.prevent="page.open = !page.open"
                    v-if="page.subpages.length > 0"
                    class="transition cursor-pointer duration-150 ease-in-out hover:bg-gray-300 rounded-md"                    
                    >
                    <svg class="h-5 w-5 transition duration-150 ease-in-out" 
                    :class="{
                        'rotate-180': page.open,
                        'rotate-0': !page.open,
                    }"
                    stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 9l6 6 6-6" />
                </svg>
            </a>
            
            {{ page.name }}
        </div>
            
                <a @click.prevent="createSubPage(page.id)" class="group cursor-pointer transition duration-150 ease-in-out hover:bg-gray-300 rounded-md">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12H18M12 6v12" />
                    </svg>
                    <p
                        class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover:opacity-100">
                        Add page inside</p>
                </a>
            </a>
            <PageSubpage
                v-if="page.subpages.length > 0" 
                :subpages="page"
                @select="selectPage"
                @create-sub-page="createSubPage"/>
        </li>
    </ul>
</template>