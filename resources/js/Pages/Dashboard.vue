<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProjectList from "@/Components/ProjectList.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const createProjectForm = useForm({
    name: "", // Hodnotu přiřazuje Laravel
});

function createNewProject() {
    createProjectForm.post(route("projects.create"), {
        preserveScroll: true,
        onSuccess: () => {
            //
        },
        onError: () => {
            //
        },
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Dashboard </template>
        <template #tagline> Welcome to your Dashboard 🎉 </template>

        <template #controls>
            <!-- <button
                    @click.prevent="createNewProject"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 cursor-pointer font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-500 focus:outline-none transition ease-in-out duration-150"
                >
                    Create New Project
            </button> -->

            <PrimaryButton @click.prevent="createNewProject">
                <box-icon
                    class="fill-blue-300"
                    name="message-square-add"
                    flip="horizontal"
                ></box-icon>
                Create Project
            </PrimaryButton>
        </template>

        <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900">
            <!-- Podmíněný výpis projektů -->
            <ProjectList />
        </div>
    </AuthenticatedLayout>
</template>
