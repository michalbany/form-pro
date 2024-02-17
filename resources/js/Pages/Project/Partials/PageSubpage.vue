<script setup>
import { defineProps, defineEmits } from "vue";
import Page from "./Page.vue";

const props = defineProps({
    subpages: Object,
});

const emit = defineEmits(["select", "create-sub-page", "delete-page"]);

function selectPage(page) {
    emit("select", page);
}

function createSubPage(parentPageId) {
    emit("create-sub-page", parentPageId);
}

function deletePage(page) {
    emit("delete-page", page);
}
</script>

<template>
    <ul v-show="subpages.open" class="flex pl-6 flex-col gap-1">
        <li v-for="page in subpages.subpages" :key="page.id">
            
            <Page
                :page="page"
                @select="selectPage"
                @create-sub-page="createSubPage"
                @delete-page="deletePage"
            />
            
            <!-- <a
                @click.prevent="selectPage(page)"
                class="flex cursor-pointer relative justify-between align-center w-full items-center px-3 py-2 bg-white rounded-md text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150"
            >
                <div class="flex gap-1">
                    <a
                        @click.prevent="page.open = !page.open"
                        v-if="page.subpages.length > 0"
                        class="transition cursor-pointer duration-150 ease-in-out hover:bg-gray-300 rounded-md"
                    >
                        <svg
                            class="h-5 w-5 transition duration-150 ease-in-out"
                            :class="{
                                'rotate-180': page.open,
                                'rotate-0': !page.open,
                            }"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 9l6 6 6-6"
                            />
                        </svg>
                    </a>

                    {{ page.name }}
                </div>

                <div class="absolute flex gap-1 right-1 items-center">
                    <a
                        @click.prevent="deletePage(page)"
                        class="group h-full text-gray-400 cursor-pointer transition duration-150 ease-in-out hover:text-red-600"
                    >
                        <svg
                            fill="currentColor"
                            height="16"
                            width="14"
                            viewBox="0 0 448 512"
                        >
                            <path
                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"
                            />
                        </svg>
                        <p
                            class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-red-600 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover:opacity-100"
                        >
                            Delete page
                        </p>
                    </a>

                    <a
                        @click.prevent="createSubPage(page.id)"
                        class="group cursor-pointer transition duration-150 ease-in-out hover:bg-gray-300 rounded-md"
                    >
                        <svg
                            class="h-5 w-5"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 12H18M12 6v12"
                            />
                        </svg>
                        <p
                            class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover:opacity-100"
                        >
                            Add page inside
                        </p>
                    </a>
                </div>
            </a> -->
            <PageSubpage
                v-if="page.subpages.length > 0"
                :subpages="page"
                @select="selectPage"
                @create-sub-page="createSubPage"
                @delete-page="deletePage"
            />
        </li>
    </ul>
</template>
