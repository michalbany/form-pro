<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputField from '@/Components/InputField.vue';

const props = defineProps({
    toedit: Object
});

const textfields = ref([]);

watchEffect(() => {
    if (props.toedit.data && props.toedit.data.textfields) {
        textfields.value = props.toedit.data.textfields;
    }
});

console.log(textfields.value);


const createFieldForm = useForm({
    label: 'New Input Field',
    content: '',
    recommended_length: '300',
    page_id: props.toedit.data.id,
})

function createField() {
    createFieldForm.post(route('fields.create'), {
        preserveScroll: true,
        onSuccess: (response) => {
            // aktualizujeme seznam polí
        }
    });
}

</script>

<template>
<!-- {{ pageName.value.data.name }} -->

<!-- <section v-for="textfield in textfields.value" :key="textfield.value.id"> -->

    <!-- <InputField 
        :title="field.label"
        :content="field.content"
        :length="field.recommended_length"
    /> -->
        <!-- this is: {{ textfield.label }} -->
    
<!-- </section> -->

<section v-for="textfield in textfields" :key="textfield.id">

    <div>{{ textfield.id }}</div>
    <div>{{ textfield.label }}</div>
    <div>{{ textfield.content }}</div>
    <div>{{ textfield.recommended_length }}</div>


</section>

<PrimaryButton @click="createField">Add field</PrimaryButton>
{{ props.toedit.data.id }}




</template>