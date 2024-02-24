<script setup>
import { ref, watchEffect, computed, onMounted } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
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
const { pages, id, name, created_at, updated_at } = usePage().props;
const project = ref({ id, name, created_at, updated_at });

watchEffect(() => {
    store.loadPages(pages);
    store.loadProjectData(project.value);
    // store.resetStore(id); // Resetujeme uložiště při změně projektu -- tedy jiné ID projektu --- Možná to není potřeba protože watchEffect se spustí jen když se změní ID projektu
});

// console.log('store:', store.pages);
// Co se týče stavu editoru, tak zjištění o jaký stav jde by mělo být už dřív řešené. Buď na dashvoard nebo na backendu
// že pokud nemáš práva na editaci, tak se ti nezobrazí tlačítko editace. A proběhne přesměrování z edit na view
watchEffect(() => {
    let mode = usePage().url.endsWith('/edit') ? true : false;
    store.setMode(mode);
});



</script>

<template>
    <Head :title="store.mode ? 'Project Edit' : 'Project View'" />
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
