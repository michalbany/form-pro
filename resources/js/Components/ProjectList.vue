<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue';

const { projects } = usePage().props;
const confirmingProjectDeletion = ref(false);
const passwordInput = ref(null);
const projectToDelete = ref(null);


const form = useForm({
    password: '',
    project_id: null, // Přidáno skryté pole pro ID projektu
});

const confirmProjectDeletion = (project) => {
    projectToDelete.value = project;
    form.project_id = project.id; // Nastavte ID projektu do formuláře
    confirmingProjectDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteProject = () => {
    form.delete(route('projects.destroy', form.project_id), {
        preserveScroll: true,
        onSuccess: () => {
            if (Array.isArray(projects)) {
                const index = projects.findIndex(p => p.id === form.project_id);
                if (index !== -1) {
                    projects.splice(index, 1);
                }
            }
            
            closeModal();
        },
            
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset('password'),
    });
    
};

const closeModal = () => {
    confirmingProjectDeletion.value = false;
    form.reset();
    projectToDelete.value = null;
};
</script>

<template>

    <div v-if="projects && projects.length">
        <ul class="flex gap-4 flex-col">
            <li class="flex flex-row items-center justify-between" v-for="project in projects" :key="project.id">
                {{ project.name }}
                
                <div class="flex gap-3">

                    <Link :href="route('projects.edit', project.id)" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Edit</Link>
                    <DangerButton @click="() => confirmProjectDeletion(project)">Delete</DangerButton>
                    
                </div>
                
            </li>
        </ul>
    </div>
    <div v-else>
        <p>No projects records.</p>
    </div>


    <Modal :show="confirmingProjectDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this project?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once project is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete this project.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteProject"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteProject"
                    >
                        Delete Project
                    </DangerButton>
                </div>
            </div>
        </Modal>

</template>