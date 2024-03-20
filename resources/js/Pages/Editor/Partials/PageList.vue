<script setup>
import PageSubpage from "./PageSubpage.vue";
import Page from "./Page.vue";
import { useProjectStore } from "@/Store/projectStore";

const store = useProjectStore();
const parentPages = store.parentPages;

</script>

<template>
    <ul class="flex flex-col gap-0.5">
        <li v-for="(page, index) in parentPages" :key="page.id">
            <!-- @idea: vždy předáváme props, abychom rozhodování jestli se jedná
            o parentPages nebo Subpages řešili ZDE -->
            <Page :page="page" />
            
            <!-- @idea: Subpage už se volá ze serveru, ale page jde z inicializace -->

            <!-- @explain: Zobrazuje se vždy pokud je nabídka otevřená
                řešení zobrazení contentu je až uvnitř -->
            <PageSubpage
                class="mt-0.5"
                v-if="store.openPages.includes(page.id)"
                :index="index"
            />

        </li>
    </ul>
</template>
