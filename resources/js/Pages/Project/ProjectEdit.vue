<script setup>
import { ref, watchEffect } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageList from './Partials/PageList.vue';
import PageDetail from './Partials/PageDetail.vue';
import ProjectSettings from './Partials/ProjectSettings.vue';
import { Head } from '@inertiajs/vue3';


const { project, pages } = usePage().props;
const toedit = ref({ type: 'project', data: project });

const breadcrumbs = ref('');

function generatedBreadcrumb(item) {
    let breadcrumb = project.name;

    if (item.type === 'page') {
        // Přidáme název stránky a její rodiče, pokud existují
        breadcrumb += ' / ' + item.data.name;
        let parent = item.data.parent;
        while (parent) {
            breadcrumb = parent.name + ' / ' + breadcrumb;
            parent = parent.parent;
        }
    }

    return breadcrumb;
}

const subPageform = useForm({
    name: 'Untitled',
    projectId: project.id,
    parentPageId: null,
});

const pageform = useForm({
    name: 'Untitled',
    projectId: null,
});

// vytváření nových stránek a podstránek
function handleCreateSubPage(parentPageId) {
    subPageform.parentPageId = parentPageId;
    subPageform.post(route('pages.create'), {
        preserveScroll: true,
        onSuccess: () => {
            // Toto je volitelné: reakce na úspěch
        },

    });
}

function handleCreatePage(projectId) {
    pageform.projectId = projectId;

    pageform.post(route('pages.create'), {
        preserveScroll: true,
        onSuccess: () => {
            // Toto je volitelné: reakce na úspěch
        }
    });
}


function handleSelect(item) {
    toedit.value = item;
    breadcrumbs.value = generatedBreadcrumb(item);
}

watchEffect(() => {
    // bread.value = toedit.value;
    breadcrumbs.value = generatedBreadcrumb(toedit.value);
});
</script>

<template>
    <Head title="Project Setup" />
    <AuthenticatedLayout>
        <div class="flex">

            <aside class="flex flex-col w-1/5 bg-white rounded-br-md p-2">
                <ProjectSettings :project="project" @select="handleSelect" @createPage="handleCreatePage"/>
                <div class="my-4 mt-1 border-gray-200 border-b"></div>
                <PageList :pages="pages" @select="handleSelect" @createSubPage="handleCreateSubPage"/>
            </aside>


            <aside class="w-4/5">
                <PageDetail :toedit="toedit">

                    <template #breadcrumbs>
                        <div class="flex w-full py-1 p-3 border-gray-200 justify-center">
                            <div class="bg-white px-2 py-1 rounded-md">
                                <h1 class="text-sm leading-6 text-indigo-600	">
                                    {{ breadcrumbs }}
                                </h1>
                            </div>
                        </div>
                    </template>

                </PageDetail>
            </aside>

        </div>
    </AuthenticatedLayout>
</template>
