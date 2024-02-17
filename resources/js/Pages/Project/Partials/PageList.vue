<script setup>
import { defineProps, defineEmits, reactive, watchEffect } from "vue";
import PageSubpage from "./PageSubpage.vue";
import Page from "./Page.vue";

const props = defineProps({
    pages: Array,
    selected: Number,
});

const emit = defineEmits(["select", "create-sub-page", "delete-page"]);

const pageHierarchy = reactive({ hierarchy: [] });

// funkce pro vytvoření hiararchie stránek a podstránek
function createHierarchy(pages) {
    let map = new Map(
        pages.map((page) => [page.id, { ...page, subpages: [], open: false }])
    );

    pageHierarchy.hierarchy = [];
    pages.forEach((page) => {
        if (page.parent_id) {
            map.get(page.parent_id).subpages.push(map.get(page.id));
        } else {
            pageHierarchy.hierarchy.push(map.get(page.id));
        }
    });
}

watchEffect(() => {
    createHierarchy(props.pages);
});

// funkce pro výběr stránky
function selectPage(page) {
    emit("select", { type: "page", data: page });
}
// funkce pro vytvoření nové stránky
function createSubPage(parentPageId) {
    emit("create-sub-page", parentPageId);
}
// funkce pro smazání stránky
function deletePage(page) {
    emit("delete-page", page);
}
</script>

<template>
    <ul class="flex flex-col gap-0.5">
        <li v-for="page in pageHierarchy.hierarchy" :key="page.id">
            <Page
                :page="page"
                :selected="selected"
                @select="selectPage"
                @create-sub-page="createSubPage"
                @delete-page="deletePage"
            />

            <PageSubpage
                class="mt-0.5"
                v-if="page.subpages.length > 0"
                :subpages="page"
                :selected="selected"
                @select="selectPage"
                @create-sub-page="createSubPage"
                @delete-page="deletePage"
            />
        </li>
    </ul>
</template>
