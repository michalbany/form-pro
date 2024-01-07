<script setup>
import { defineProps, ref, watchEffect } from "vue";
import { useForm } from "@inertiajs/vue3";
import TitleInput from "@/Components/TitleInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
                class="mt-1 border-none focus:outline-none focus:border-none focus:ring focus:ring-2 focus:ring-gray-300 rounded-md font-sans resize-none block w-full text-xl"
                rows="4"
                placeholder="Enter TextField Content"
                v-model="props.content"
            ></textarea>
        </div>

        <div class="flex justify-between">
            <!-- @change: v-model -->

            <!-- <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                        
                        <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                        >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition> -->

            <div class="flex gap-3 items-center">
                <p>Recommended Text Length</p>
                <TitleInput
                    id="recommended_length"
                    type="number"
                    class="mt-1 block bg-white rounded-md p-1 text-lg w-16"
                    placeholder="Enter Recommended Length"
                    autocomplete="off"
                    v-model="props.recommended_length"
                />
            </div>

            <div class="flex items-center gap-4 mt-3">
                <PrimaryButton>Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </div>
    </form>
    <!-- <div>{{ props.id }}</div> -->
    <!-- <div>{{ props.label }}</div> -->
    <!-- <div>{{ props.content }}</div> -->
    <!-- <div>{{ props.recommended_length }}</div> -->
</template>

<style scoped>
/* textarea:active, textarea:focus {
        box-shadow: none;
    } */
</style>
