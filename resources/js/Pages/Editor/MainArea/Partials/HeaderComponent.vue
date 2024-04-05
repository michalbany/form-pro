<script setup>
import TitleInput from '@/Components/TitleInput.vue';

defineProps({
    component: Object,
});


</script>


<template>
   <!-- {{ component.type }} -->
        <TitleInput
            type="text"
            class="block w-full text-xl"
            placeholder="Enter Header Content"
            autocomplete="off"
            v-model="component.content"
        />

</template>
