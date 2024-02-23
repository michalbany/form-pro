<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TitleInput from '@/Components/TitleInput.vue';
import TextField from './TextField.vue';  

const props = defineProps({
    toedit: Object
});


const page = ref(props.toedit);

watchEffect(() => {
    page.value = props.toedit;
});


const form = useForm({
    name: '',
});

watchEffect(() => {
  form.name = props.toedit.data.name;
});

// změna názvu
function saveChanges() {
    let route;

    switch (props.toedit.type) {
        case 'project':
            route = `/projects/${props.toedit.data.id}`;
            break;
        case 'page':
            route = `/pages/${props.toedit.data.id}`;
            break;
    }
    if (form.name === '') {
        form.name = 'Untitled'
    }

    form.put(route, {
        preserveScroll: true,
        onSuccess: () => {
            props.toedit.data.name = form.name;
        },
        onError: () => {
            //
        }
    });
}

</script>

<template>
    <!-- <slot name="breadcrumbs"/> -->

    <main class="px-24">

        <section>
            <form @submit.prevent="saveChanges" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Title" />
                    
                    <TitleInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full text-3xl"
                    v-model="form.name"
                    placeholder="Enter new title"
                    autocomplete="off"
                    />
                
                    <InputError class="mt-2" :message="form.errors.name" />
                    <div class="flex items-center gap-4 mt-3">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                        
                        <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                        >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </div>
            
        </form>
    </section>

    
    <TextField v-if="props.toedit.type === 'page'" :toedit="page" />

    <section v-else>
        <p class="text-gray-600 mt-4">Zde bude možnost vygenerovat klíč pro klienta + zobrazit lidi, kteří na projektu pracují.</p>
    </section>
    </main>
</template>