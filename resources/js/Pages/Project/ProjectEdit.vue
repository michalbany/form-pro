<script setup>
import { ref, watchEffect, computed } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageList from './Partials/PageList.vue';
import PageDetail from './Partials/PageDetail.vue';
import ProjectSettings from './Partials/ProjectSettings.vue';
import { Head } from '@inertiajs/vue3';

const { project } = usePage().props;
const toedit = ref({ type: 'project', data: project });
const pages = ref(usePage().props.pages);


const breadcrumbs = ref('');


const subPageform = useForm({
    name: 'Untitled',
    projectId: project.id,
    parentPageId: null,
});

const pageform = useForm({
    name: 'Untitled',
    projectId: null,
});

const deletePageForm = useForm({
    page: null,
});

function handleDelete(item) {
    deletePageForm.page = item;
    deletePageForm.delete(route('pages.destroy', deletePageForm.page), {
        preserveScroll: true,
        onSuccess: (response) => {
            // aktualizujeme seznam polí
            pages.value = response.props.pages;
            handleSelect({ type: 'project', data: project });
        },
    });
}

// vytváření nových stránek a podstránek
function handleCreateSubPage(parentPageId) {
    subPageform.parentPageId = parentPageId;
    subPageform.post(route('pages.create'), {
        preserveScroll: true,
        onSuccess: (response) => {
            const pageToSelect = response.props.pages[response.props.pages.length - 1];

            pages.value = response.props.pages;
            handleSelect({ type: 'page', data: pageToSelect});

        },

    });
}

function handleCreatePage(projectId) {
    pageform.projectId = projectId;

    pageform.post(route('pages.create'), {
        preserveScroll: true,
        onSuccess: (response) => {
            const pageToSelect = response.props.pages[response.props.pages.length - 1];

            pages.value = response.props.pages;
            handleSelect({ type: 'page', data: pageToSelect});
        }
    });
}


function handleSelect(item) {
    toedit.value = item;
}

watchEffect(() => {
    breadcrumbs.value = generatedBreadcrumb(toedit.value, pages.value);
});


// 3 funkce pro generování breadcrumb
function findPageById(pageId, pages) {
    return pages.find(page => page.id === pageId);
}

function generateBreadcrumbPath(page, pages, path = []) {
    if (page.parent_id) {
        const parentPage = findPageById(page.parent_id, pages);
        if (parentPage) {
            path.unshift(parentPage.name);
            generateBreadcrumbPath(parentPage, pages, path);
        }
    }
    return path;
}

function generatedBreadcrumb(item, pages) {
    let breadcrumb = [project.name];

    if (item.type === 'page') {
        const breadcrumbPath = generateBreadcrumbPath(item.data, pages);
        breadcrumb = [...breadcrumb, ...breadcrumbPath, item.data.name];
    }

    return breadcrumb.join(' / ');
    
}

</script>

<template>
    <Head title="Project Setup" />
    <AuthenticatedLayout>
        <div class="flex">

            <aside class="flex flex-col w-80 bg-white rounded-br-md p-2">
                <ProjectSettings :project="project" @select="handleSelect" @create-page="handleCreatePage"/>
                <div class="my-4 mt-1 border-gray-200 border-b"></div>
                
                <PageList :pages="pages" @select="handleSelect" @create-sub-page="handleCreateSubPage" @delete-page="handleDelete"/>
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
