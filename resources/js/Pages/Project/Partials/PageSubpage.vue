<script setup>
import { defineProps, defineEmits } from "vue";
import Page from "./Page.vue";

const props = defineProps({
    subpages: Object,
    selected: Number,
});

const emit = defineEmits(["select", "create-sub-page", "delete-page"]);

function selectPage(page) {
    emit("select", page);
}

function createSubPage(parentPageId) {
    emit("create-sub-page", parentPageId);
}

function deletePage(page) {
    emit("delete-page", page);
}
</script>

<template>
    <ul
        v-show="subpages.open"
        class="flex pl-6 flex-col gap-0.5 relative :pseudo-line"
    >
        <li v-for="page in subpages.subpages" :key="page.id">
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

<style>
.\:pseudo-line::before {
    content: "";
    position: absolute;
    bottom: 5px;
    top: 5px;
    left: 13px;
    width: 2px;
    border-radius: 5px;
    height: auto;
    background-color: #60a5fa;
}
</style>
