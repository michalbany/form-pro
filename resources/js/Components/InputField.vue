<script setup>
import { defineProps, defineEmits, ref, watchEffect, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TitleInput from '@/Components/TitleInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    textfield: Object
});
const emit = defineEmits(["update", "delete"]);


const form = useForm({
    label: props.textfield.label,
    content: props.textfield.content,
    recommended_length: props.textfield.recommended_length,
    
});

// odeslání textfieldu, který se má smazat
function deleteField() {
    emit("delete", props.textfield);
}

// poslaní změn na server a aktualizace seznamu polí v rodiči
function updateField() {
    if (form.label === "") {
        form.label = "Untitled";
    }
    if (form.recommended_length === "" || form.recommended_length === null || form.recommended_length <= 0 ) {
        form.recommended_length = 100;
    }

    form.put(route("fields.update", props.textfield.id), {
        preserveScroll: true,
        onSuccess: (response) => {
            // aktualizujeme seznam polí
            emit("update", {...props.textfield, ...form });
        },
    });
}

watchEffect(() => {
    form.label = props.textfield.label;
    form.content = props.textfield.content;
    form.recommended_length = props.textfield.recommended_length;
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
    <form @submit.prevent="updateField" class="mt-6 space-y-6">
        <div>
            <InputLabel for="label" value="TextField Title" />

            <TitleInput
                id="label"
                type="text"
                class="mt-1 block w-full text-2xl"
                placeholder="Enter TextField Label"
                autocomplete="off"
                v-model="form.label"
            />

            <textarea
                id="content"
                class="mt-1 border-none focus:outline-none focus:border-none focus:ring focus:ring-2 focus:ring-gray-300 rounded-md font-sans resize-none block w-full text-xl"
                rows="4"
                placeholder="Enter TextField Content"
                v-model="form.content"
            ></textarea>
        </div>

        <div class="flex justify-between">

            <div class="flex gap-3 items-center">
                
                <input 
                type="number" 
                class="mt-1 block bg-white rounded-md p-1 text-lg w-20"
                placeholder="Enter Recommended Length"
                autocomplete="off"
                v-model="form.recommended_length"
                />
                <p class="text-gray-500">characters</p>
            </div>

            <div class="flex items-center gap-4 mt-3">
                <span
                    :class="{
                        'text-green-500': contentLengthDifference === 'Perfect',
                        'text-red-500': contentLengthDifference < -20 || contentLengthDifference > 20,
                        'text-yellow-500': contentLengthDifference >= -20 && contentLengthDifference <= 20 && contentLengthDifference !== 'Perfect',
                    }"
                    >{{ contentLengthDifference }}</span>

                <DangerButton @click.prevent="deleteField">Delete</DangerButton>
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
</template>
