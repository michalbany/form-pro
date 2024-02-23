<script setup>
import { ref, watchEffect, computed } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import EditorLayout from '@/Layouts/EditorLayout.vue';
import PageList from './Partials/PageList.vue';
import PageDetail from './Partials/PageDetail.vue';
import ProjectSettings from './Partials/ProjectSettings.vue';
import { Head } from '@inertiajs/vue3';
import { useProjectStore } from "@/Store/projectStore";

/**
 * This file is a Global Settings for the Editor
 * 
 * @does Render SideBar, Project Settings and Global Functions
 */
const store = useProjectStore();
const { pages, id, name, created_at, updated_at } = usePage().props;
const project = ref({ id, name, created_at, updated_at });

watchEffect(() => {
    store.loadPages(pages);
});

watchEffect(() => {
    store.loadProjectData(project.value);
});

watchEffect(() => {
    let mode = usePage().url.endsWith('/edit') ? true : false;
    store.setMode(mode);
});



</script>

<template>
    <Head :title="$page.url.endsWith('/edit') ? 'Project Edit' : 'Project View'" />
    <EditorLayout>

        <!-- Side Bar -->
        <template #project-settings>
            <ProjectSettings />
        </template>
        
        <template #page-list>
            <PageList />
        </template>
        

        <!-- On preference -->
        <template #breadcrumbs>
            <!-- {{ breadcrumbs }} -->
        </template>
            

            
        <!-- Main Content Area -->
        <template #main-content>
<!-- Musíme rozhodnout, který zobrazujeme (může to být podle URL)
        Po kliknutí na link v navigaci otevřeme jeden z těchto komponentů a v nich budeme volat data. V závislosti na URL        
    ON LINK OPEN: <ProjectEditor /> DEFAULT
                <PageEditor />
                <PageView />
                <ProjectView /> DEFAULT
 -->

        <!-- <PageDetail :page="page" :selected="selected" @select="handleSelect" @create-sub-page="handleCreateSubPage" @delete-page="handleDelete" /> -->
        </template>

    </EditorLayout>
</template>
