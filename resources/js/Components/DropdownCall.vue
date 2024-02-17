

<template>
    <div @click.prevent="$emit('dropdown-click')"
    class="flex group items-center gap-2 cursor-pointer w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
    >
        <slot />
    </div>
    </template>
