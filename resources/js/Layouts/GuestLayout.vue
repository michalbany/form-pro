<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen items-center justify-items-center grid grid-cols-1 background-pattern selection:bg-blue-200 selection:text-red-300"
    >
            <div>

                <slot />
            </div>
    </div>
</template>

<style>
.background-pattern {
    background-image: url('../../images/background.svg');
}
</style>