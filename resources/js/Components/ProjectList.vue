<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, nextTick } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownCall from "@/Components/DropdownCall.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const { projects } = usePage().props;
const confirmingProjectDeletion = ref(false);
const passwordInput = ref(null);
const projectToDelete = ref(null);

const form = useForm({
    password: "",
    project_id: null, // Přidáno skryté pole pro ID projektu
});

const confirmProjectDeletion = (project) => {
    projectToDelete.value = project;
    form.project_id = project.id; // Nastavte ID projektu do formuláře
    confirmingProjectDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteProject = () => {
    form.delete(route("projects.destroy", form.project_id), {
        preserveScroll: true,
        onSuccess: () => {
            if (Array.isArray(projects)) {
                const index = projects.findIndex(
                    (p) => p.id === form.project_id
                );
                if (index !== -1) {
                    projects.splice(index, 1);
                }
            }

            closeModal();
        },

        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset("password"),
    });
};

const closeModal = () => {
    confirmingProjectDeletion.value = false;
    form.reset();
    projectToDelete.value = null;
};
</script>

<template>
    <div v-if="projects && projects.length" class="mb-6 sm:mx-0 mx-2">
        <!-- <box-icon name="file-blank" class="fill-blue-800 w-8 h-8"></box-icon> -->
        <h1 class="mb-2 text-3xl font-semibold">🤗Your Projects</h1>
        <p>Dive in and navigate through your creations.</p>
    </div>
    <ul
        v-if="projects && projects.length"
        class="flex gap-4 flex-col divide-y divide-gray-200"
    >
        <li
            class="flex justify-between items-center py-3 "
            v-for="project in projects"
            :key="project.id"
        >
            <div class="pl-3">
                <div class="flex mb-1 items-center gap-4">
                    <h4 class="font-semibold text-lg">
                        {{ project.name }}
                    </h4>
                    <span class="border box-border text-sm bg-green-100 border-green-400 py-0.5 text-green-800 px-2 rounded-lg">
                        Status
                    </span>
                </div>

                <p class="text-sm text-gray-600">
                    {{ new Date(project.created_at).toLocaleDateString() }} · Created by Michael Bany
                </p>
            </div>

            <div class="flex gap-3">
                <Link
                    :href="route('projects.edit', project.id)"
                    class="hidden sm:inline-flex items-center px-4 py-2 bg-gray-100 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 focus:outline-none disabled:opacity-25 transition"
                    >Edit Project</Link
                >

                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="group inline-flex items-center px-3 py-2 transition"
                                            >

                                            <box-icon name='dots-vertical-rounded' class="fill-blue-800 group-hover:fill-gray-400 group-focus:fill-red-200 transition"></box-icon>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('projects.edit', project.id)" class="sm:hidden">
                                            <box-icon name='pencil' type='solid' class="h-5 w-5 fill-gray-400 group-hover:fill-blue-500 transition"></box-icon>
                                            Edit Project
                                        </DropdownLink>
                                        
                                        <DropdownCall @dropdown-click="() => confirmProjectDeletion(project)">
                                            <box-icon type='solid' name='trash-alt' class="h-5 w-5 fill-gray-400 group-hover:fill-red-500 transition"></box-icon>
                                            Delete                                            
                                        </DropdownCall>
                                        
                                    </template>
                                </Dropdown>
            </div>
        </li>
    </ul>
    <div v-else>
        <h2 class="text-3xl text-center font-semibold mb-4">
            😶‍🌫️Whoops! Where are they?
        </h2>
        <p class="mx-6 leading-normal text-center">
            Your project list is currently as empty as a desert oasis!<br> Why
            not create your first project now and bring this oasis to life?
        </p>
    </div>

    <Modal :show="confirmingProjectDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete this project?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once project is deleted, all of its resources and data will be
                permanently deleted. Please enter your password to confirm you
                would like to permanently delete this project.
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
