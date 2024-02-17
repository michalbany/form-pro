<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    project: Object,
    selected: Number,
  });


const emit = defineEmits(["select", "create-page"]);

// funkce pro výběr projektu
function selectProject() {
    emit("select", { type: "project", data: props.project });
}

// funkce pro vytvoření nové stránky
function createPage() {
    emit("create-page", props.project.id);
}

</script>

<template>
    <a
        :title="project.name"
        @mouseover="hover = true"
        @mouseleave="hover = false"
        href="#"
        @click.prevent="selectProject"
        :class="{
            'bg-blue-600': selected === project.id,
        }"
        class="relative min-h-11 group flex justify-between items-center px-3 py-2 rounded-md font-semibold text-md text-white hover:bg-blue-600 transition"
    >
        <div class="flex items-center gap-2 truncate">
            <box-icon
                class="fill-white group-hover:fill-blue-200 w-5 h-5 transition flex-shrink-0"
                type="solid"
                name="file-blank"
            ></box-icon>
            <span class="select-none truncate">
              {{ project.name }}
              <!-- {{ hover ? trimText(project.name, 20) : trimText(project.name, 25) }} -->
            </span>
        </div>

        <a
            href="#"
            @click.prevent="createPage"
            class="ml-1 group-hover:flex items-center hidden justify-center p-1 group/plus transition hover:bg-red-300 rounded-md"
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
    </a>
</template>
