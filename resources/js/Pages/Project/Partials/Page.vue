<script setup>
import { defineEmits, defineProps } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownCall from "@/Components/DropdownCall.vue";

const props = defineProps({
    page: Object,
    selected: Number,
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
    <a
        class="cursor-pointer relative group flex justify-between items-center px-3 py-1 min-h-8 rounded-md font-semibold text-md text-white hover:bg-blue-600 transition"
        :class="{
            'selected-item': selected === page.id,
        }"
        :title="page.name"
       
    >
        <div class="flex items-center gap-1 flex-grow truncate">
            <a
                @click.prevent="page.open = !page.open"
                v-if="page.subpages.length > 0"
                class="group/arrow flex items-center justify-center p-0.5 transition hover:bg-blue-500 rounded-md"
            >
                <box-icon
                    class="fill-blue-300 group-hover/arrow:fill-white h-5 w-5 transition"
                    :class="{
                        'rotate-90': page.open,
                        'rotate-0': !page.open,
                    }"
                    name="chevron-right"
                ></box-icon>
            </a>

            <span
                class="text-sm flex-grow select-none truncate"
                @click.prevent="selectPage(page)"
            >
                {{ page.name }}
            </span>
        </div>

        <div class="ml-1 hidden group-hover:flex gap-1 items-center">
            

                <Dropdown align="left" width="48">
                    <template #trigger>
                        <button
                        type="button"
                        class="group/arrow flex items-center justify-center p-0.5 transition hover:bg-blue-500 rounded-md"
                        >
                        <box-icon
                        name="dots-vertical-rounded"
                        class="h-5 w-5 fill-blue-300 group-hover/arrow:fill-white"
                        ></box-icon>
                    </button>
                </template>
                
                <template #content>
                    <DropdownCall @dropdown-click="deletePage(page)">
                        <box-icon
                        type="solid"
                        name="trash-alt"
                        class="h-5 w-5 fill-gray-400 group-hover:fill-red-300 transition"
                        ></box-icon>
                        Delete
                    </DropdownCall>
                </template>
            </Dropdown>
            
            <a
                @click.prevent="createSubPage(page.id)"
                class="flex items-center justify-center p-0.5 group/plus transition hover:bg-red-300 rounded-md"
            >
                <box-icon
                    class="h-5 w-5 fill-white"
                    name="message-alt-add"
                ></box-icon>
                <p
                    class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover/plus:opacity-100"
                >
                    Add page inside
                </p>
            </a>
        </div>
    </a>
</template>

<style>
.selected-item {
    background-color: #376fe9;
}

</style>
