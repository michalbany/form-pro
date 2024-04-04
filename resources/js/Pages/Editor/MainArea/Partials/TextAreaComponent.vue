<script setup>
import { defineProps, computed } from 'vue';

defineProps({
    component: Object,
});

const contentLengthDifference = computed(() => {
    if (form.content === null) {
        form.content = '';
    }
    let content = String(form.content);
    let difference = content.length - form.recommended_length;

    let output = '';
    if (difference > 0) {
        output = `+${difference}`;
    } else if (difference < 0) {
        output = `${difference}`;
    } else {
        output = 'Perfect';
    }
    return output;
});
</script>


<template>
   {{ component.id }}

</template>