<script setup>
import { reactive, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';
import EditorLayout from '@/Layouts/EditorLayout.vue';
import PageList from './Partials/PageList.vue';
import ProjectSettings from './Partials/ProjectSettings.vue';
import { Head } from '@inertiajs/vue3';
import { useProjectStore } from "@/Store/projectStore";

/**
 * This file is a Global Settings for the Editor
 * 
 * @does Render SideBar, Project Settings and Global Functions
 */
const store = useProjectStore();
const { project, parentPages } = usePage().props.initData;

// Nyní načteme inicializační data do store, aby byly dostupné i v jiných routách
store.loadPages(parentPages);
store.loadProjectData(project);


// další globální nastavení editoru

</script>

<template>
    <Head title="Editing..." />
    <EditorLayout>

        <!-- Side Bar -->
        <template #project-settings>
            <ProjectSettings 
                :active="store.activePage === null ? true : false"
            />
        </template>
        
        <template #page-list>
            <PageList/>
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

 <!-- @!!! -->
 <!-- @idea: Zjistíme jestli máme data pro Page pokud
     ne tak používáme inicializační data. Data z Page jdou přes InertiaPage -->

        <!-- <PageDetail :page="page" :selected="selected" @select="handleSelect" @create-sub-page="handleCreateSubPage" @delete-page="handleDelete" /> -->
        </template>

    </EditorLayout>
</template>
