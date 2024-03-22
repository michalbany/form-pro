<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useProjectStore } from "@/Store/projectStore";


const store = useProjectStore();
const editorMode = ref(store.getActiveMode());
const project = ref(store.projectData);


const props = defineProps({
    active: Boolean,
})

/**
 * 
 * Routy se musí nastavovat nastavovat reaktivně. Jestli edit. nebo view.??? 
 * Ve store budeme muset uchovávat aktuální stav jestli je editor ve view modu nebo edit modu 
 */




</script>

<template>
    <Link
        @click="store.setActivePage(null)"
        preserve-state
        replace
        :title="project.name"
        :href="route(`${editorMode}.project.show`, project.id)"
        :class="{
            'bg-gray-200': active,
        }"
        class="relative min-h-11 flex group justify-between items-center px-3 py-2 rounded-md font-semibold text-md text-foreground hover:bg-gray-200 transition"
    >
        <div class="flex items-center gap-2 truncate">
            <box-icon
                class="fill-blue-500 w-5 h-5 transition flex-shrink-0"
                type="solid"
                name="file-blank"
            ></box-icon>
            <span class="select-none truncate">
              {{ project.name }}
            </span>
        </div>

        <a
            href="#"
            class="ml-1 cursor-pointer group-hover:flex items-center hidden justify-center p-1 group/plus transition hover:bg-red-300 rounded-md"
        >
            <box-icon
                class="h-5 w-5"
                name="message-alt-add"
            ></box-icon>
            <p
                class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover/plus:opacity-100"
            >
                Add page inside
            </p>
        </a>
    </Link>
</template>
