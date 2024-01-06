<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TitleInput from '@/Components/TitleInput.vue';

const props = defineProps({
    toedit: Object
});

const form = useForm({
    name: '', // Toto nastaví počáteční hodnotu názvu
});

watchEffect(() => {
  form.name = props.toedit.data.name; // Toto zajistí, že form.name se aktualizuje při každé změně props.toedit
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
            // Toto je volitelné: reakce na chyby
        }
    });
}

</script>

<template>
    <slot name="breadcrumbs"/>

    <main class="px-24">

        <section>
            <form @submit.prevent="saveChanges" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Title" />
                    
                    <TitleInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
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
    </main>
</template>