<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProjectList from '@/Components/ProjectList.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const createProjectForm = useForm({
    'name': '', // Hodnota definovaná v backendu
});

function createNewProject() {
    createProjectForm.post(route('projects.create'),
    {
        preserveScroll: true,
        onSuccess: () => {
            //
        },
        onError: () => {
            // Toto je volitelné: reakce na chyby
        }
    });
}


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <template #controls>
            <div class="flex-shrink-0 pt-4">
                <button
                    @click.prevent="createNewProject"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 cursor-pointer font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none transition ease-in-out duration-150"
                >
                    Create New Project
            </button>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Podmíněný výpis projektů -->
                        <ProjectList />
                    
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>