<script setup>
import { defineProps, computed } from 'vue';
import TextEditor from '@/Components/TextEditor.vue'


const props = defineProps({
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
   <!-- {{ component.type }} -->

   <TextEditor :content="component.content" />

   <!-- <textarea
        class="border-none focus:outline-none focus:border-none focus:ring-2 focus:ring-gray-300 rounded-md font-sans resize-none block w-full text-md"
        rows="5"
        placeholder="Enter TextField Content"
        v-model="component.content"
        /> -->


</template>