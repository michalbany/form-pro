<script setup>
import { usePage } from "@inertiajs/vue3";

const { project } = usePage().props.initData

</script>

<template>
    <h2>{{ project.name }}</h2>
</template>