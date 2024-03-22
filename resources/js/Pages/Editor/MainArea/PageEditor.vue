<script setup>
import { usePage } from "@inertiajs/vue3";
import { watchEffect, ref } from "vue";

const pageData = ref(null)
watchEffect(() => {
    const { page } = usePage().props.pageData
    pageData.value = page
})

</script>

<template>
    <main class="px-12">
        <section class="mt-6">
            <h1 class="block w-full text-3xl">{{ pageData.name }}</h1>
        </section>

    </main>
</template>