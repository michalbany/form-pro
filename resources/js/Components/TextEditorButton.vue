<script setup>
const props = defineProps({
    icon: String,
    selected: Boolean
});


</script>

<template>
    <button class="inline-flex rounded bg-gray-100 p-1 hover:bg-gray-200 transition"
        :class="{
            'bg-blue-100': selected
        }"
    >
        <box-icon
            class="h-5 w-5"
            :class="{
            'fill-blue-700': selected
        }"
            :name='icon' />
        </button>
</template>