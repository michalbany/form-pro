<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
);

const titleClasses = computed(() =>
    props.active ? "text-blue-500" : "text-gray-500"
);
const iconClasses = computed(() =>
    props.active ? "fill-blue-500" : "fill-gray-500"
    );
    
</script>

<template>
    <Link :href="href" :class="classes" class="flex gap-2">
        <span :class="iconClasses">
            <slot name="icon" />
        </span>
        <span :class="titleClasses">
            <slot name="title" />
        </span>
    </Link>
</template>
