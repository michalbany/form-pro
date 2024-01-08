<script setup>
import { defineProps, ref, watchEffect } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputField from '@/Components/InputField.vue';

const props = defineProps({
    toedit: Object
});

const toedit = ref(props.toedit);


watchEffect(() => {
    toedit.value = props.toedit;
    // console.log(toedit.value.data);


});

const textfields = ref([]);


watchEffect(() => {
    if (props.toedit.data && props.toedit.data.textfields) {
        textfields.value = props.toedit.data.textfields;
    }
    // console.log(textfields.value);
});



const createFieldForm = useForm({
    label: 'New Input Field',
    content: '',
    recommended_length: 300,
    page_id: null,
});

function createField(page_id) {
    createFieldForm.page_id = page_id;
    createFieldForm.post(route('fields.create'), {
        preserveScroll: true,
        onSuccess: (response) => {
            // aktualizujeme seznam polí

            // v response najdeme index, kde je page_id a vybereme z něj nová pole
            const index = response.props.pages.findIndex(p => p.id === page_id);

            if (index !== -1) {
                textfields.value = response.props.pages[index].textfields;
                props.toedit.data.textfields = response.props.pages[index].textfields;
            }

            // console.log(response);
        }
    });
}

const deleteFieldForm = useForm({
    textfield: null,
    // withsubpages: false,
});


function handleDeleteField(field) {
    deleteFieldForm.textfield = field;
    deleteFieldForm.delete(route('fields.destroy', deleteFieldForm.textfield), {
        preserveScroll: true,
        onSuccess: (response) => {
            // aktualizujeme seznam polí

            // vezmeme id aktuální stránky
            const page_id = props.toedit.data.id;
            console.log(page_id);            
            // v response najdeme index, kde je page_id a vybereme z něj nová pole
            const index = response.props.pages.findIndex(p => p.id === page_id);

            if (index !== -1) {
                textfields.value = response.props.pages[index].textfields;
                props.toedit.data.textfields = response.props.pages[index].textfields;
            }
            
        },
        onError: () => {
            // console.log('error');
        }
    });
}

function handleUpdateField(field) {
    const index = textfields.value.findIndex(f => f.id === field.id);

    if (index !== -1) {
        textfields.value[index] = field;
    }	
}

</script>

<template>
<section v-for="textfield in textfields" :key="textfield.id">

    

    <InputField
        :textfield="textfield"
        @update="handleUpdateField"
        @delete="handleDeleteField"
    />


</section>

<PrimaryButton class="my-4 bg-indigo-700 hover:bg-indigo-800" @click="createField(toedit.data.id)">Add field</PrimaryButton>
<!-- {{ props.toedit.data.id }} -->




</template>