<script setup>
import { defineProps } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownCall from "@/Components/DropdownCall.vue";
import { Link } from "@inertiajs/vue3";
import { useProjectStore } from "@/Store/projectStore";
import { router as Inertia } from "@inertiajs/vue3";

const store = useProjectStore();
const projectID = store.projectData.id;

const props = defineProps({
    page: Object,
    active: Boolean,
});

function loadSubpages(pageId) {
    // Aktualizace aktuální stránky s novým parametrem, který indikuje, že chceme načíst podstránky
    if (store.openPages.includes(pageId)) {
        store.togglePage(pageId);
        return;
    }

    Inertia.reload({
        only: ["subpages"],
        data: { page: pageId },
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: (page) => {
            store.togglePage(pageId);
        },
    });
}
</script>

<template>
    <div
        class="cursor-pointer relative group flex justify-between items-center px-3 py-1 min-h-8 rounded-md font-semibold text-md text-foreground hover:bg-gray-200 transition"
        :class="{
            'bg-gray-200': active,
        }"
    >
        <div class="flex items-center gap-1 flex-grow truncate">
            <a
                @click.prevent="loadSubpages(page.id)"
                class="group/arrow flex items-center justify-center p-0.5 transition hover:bg-gray-300 rounded-md"
            >
                <box-icon
                    class="fill-blue-300 group-hover/arrow:fill-blue-500 h-5 w-5 transition"
                    :class="{
                        'rotate-90': store.openPages.includes(page.id),
                        'rotate-0': !store.openPages.includes(page.id),
                    }"
                    name="chevron-right"
                ></box-icon>
            </a>

            <Link
                @click="store.setActivePage(page.id)"
                :title="page.name"
                :href="
                    route('edit.page.show', {
                        project: projectID,
                        page: page.id,
                    })
                "
                preserve-state
                replace
                class="text-sm flex-grow select-none truncate"
            >
                {{ page.name }}
            </Link>
        </div>

        <div class="ml-1 hidden group-hover:flex gap-1 items-center">
            <Dropdown align="left" width="48">
                <template #trigger>
                    <button
                        type="button"
                        class="group/arrow flex items-center justify-center p-0.5 transition hover:bg-gray-300 rounded-md"
                    >
                        <box-icon
                            name="dots-vertical-rounded"
                            class="h-5 w-5 fill-blue-300 group-hover/arrow:fill-blue-500"
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
                class="flex items-center justify-center p-0.5 group/plus transition hover:bg-red-300 rounded-md"
            >
                <box-icon class="h-5 w-5" name="message-alt-add"></box-icon>
                <p
                    class="absolute pointer-events-none opacity-0 left-full top-1/2 -translate-y-1/2 text-xs text-nowrap normal-case bg-gray-800 text-white p-1 transition duration-150 ease-in-out rounded-md group-hover/plus:opacity-100"
                >
                    Add page inside
                </p>
            </a>
        </div>
    </div>
</template>

<style></style>
