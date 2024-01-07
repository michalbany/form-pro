<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputField from '@/Components/InputField.vue';

const props = defineProps({
    toedit: Object
});

// console.log(props);

const toedit = ref(props.toedit);

watchEffect(() => {
    toedit.value = props.toedit;

    // console.log(toedit.value);

});


const textfields = ref([]);

watchEffect(() => {
    if (props.toedit.data && props.toedit.data.textfields) {
        textfields.value = props.toedit.data.textfields;
    }
});

// console.log(props.toedit.data);




const createFieldForm = useForm({
    label: 'New Input Field',
    content: '',
    recommended_length: '300',
    page_id: null,
});

function createField(page_id) {
    createFieldForm.page_id = page_id;
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

    

    <InputField
        :id="textfield.id"
        :label="textfield.label"
        :content="textfield.content"
        :recommended_length="textfield.recommended_length"
    />


</section>

<PrimaryButton class="mt-4 bg-indigo-700 hover:bg-indigo-800" @click="createField(toedit.data.id)">Add field</PrimaryButton>
<!-- {{ props.toedit.data.id }} -->




</template>