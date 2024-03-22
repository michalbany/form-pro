<script setup>
import { usePage } from "@inertiajs/vue3";
import { watchEffect, ref } from "vue";

console.log(usePage().props)

const pageData = ref(null)
watchEffect(() => {
    const { page } = usePage().props.pageData
    pageData.value = page
})

</script>

<template>
    <h2>{{ pageData.name }}</h2>
</template>