<script setup>
import { reactive } from "vue";
import PageSubpage from "./PageSubpage.vue";
import Page from "./Page.vue";
import { useProjectStore } from "@/Store/projectStore";

const store = useProjectStore();
// const pages = reactive(store.pages);
const parentPages = store.parentPages;
console.log(parentPages[1].name);
</script>

<template>
    <ul class="flex flex-col gap-0.5">
        <li v-for="(page, index) in parentPages" :key="page.id">

            <!-- @idea: vždy předáváme props, abychom rozhodování jestli se jedná
            o parentPages nebo Subpages řešili ZDE -->
            <Page 
            :page="page"
            />

            <!-- @idea: Subpage už se volá ze serveru, ale page jde z inicializace -->
            <!-- 
            <PageSubpage
                class="mt-0.5"
                v-if="Object.keys(page.children).length > 0"
                :open="page.open"
                :children="page.children"
            /> -->
        </li>
    </ul>
</template>
