<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TitleInput from '@/Components/TitleInput.vue';
import InputLabel from '@/Components/InputLabel.vue';


const props = defineProps({
    id: Number,
    label: String,
    content: String,
    recommended_length: Number,
});

</script>


<template>

    <form class="mt-6 space-y-6">
        <div>
            <InputLabel for="label" value="TextField Title" />

            <!-- @change: v-model -->
            <TitleInput
            id="label"
            type="text"
            class="mt-1 block w-full text-2xl"
            placeholder="Enter TextField Label"
            autocomplete="off"
            v-model="props.label"
            />
            
            <!-- @change: v-model -->
            <textarea
                id="content"
                class="mt-1 border-none focus:outline-none focus:border-none focus:ring-none rounded-md font-sans resize-none block w-full text-xl"
                rows="4"
                placeholder="Enter TextField Content"
                v-model="props.content"
            ></textarea>
        </div>

        
        
    </form>
    <!-- <div>{{ props.id }}</div> -->
    <!-- <div>{{ props.label }}</div> -->
    <!-- <div>{{ props.content }}</div> -->
    <!-- <div>{{ props.recommended_length }}</div> -->
</template>