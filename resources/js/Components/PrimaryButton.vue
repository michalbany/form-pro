<template>
    <button
        class="inline-flex items-center hover:btn-shadow px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 transition"
    >
        <slot />
    </button>
</template>

<style>
.hover\:btn-shadow:hover {
    box-shadow: -4px 4px 0px #fc8181;
}
</style>