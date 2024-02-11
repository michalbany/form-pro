<template>
    <button
    class="inline-flex hover:animate-shake items-center gap-2 hover:btn-shadow-danger px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition"

    >
        <slot />
    </button>
</template>
<style>
.hover\:btn-shadow-danger:hover {
    box-shadow: -4px 4px 0px #1d4ed8;
}

.hover\:animate-shake:hover {
    animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
}

@keyframes shake {
    10%, 90% {
        transform: translate3d(-1px, 0, 0);
    }

    20%, 80% {
        transform: translate3d(2px, 0, 0);
    }

    30%, 50%, 70% {
        transform: translate3d(-4px, 0, 0);
    }

    40%, 60% {
        transform: translate3d(4px, 0, 0);
    }
}
</style>