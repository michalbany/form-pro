<script setup>
import { defineProps } from "vue";
import Page from "./Page.vue";
import { useProjectStore } from "@/Store/projectStore";

const store = useProjectStore();

const props = defineProps({
    children: Object,
    open: Boolean,
});


</script>

<template>
    <ul
        v-show="open"
        class="flex pl-6 flex-col gap-0.5 relative :pseudo-line"
    >
        <li v-for="page in children" :key="page.id">
            
            <Page
                :page="page"
                :key="page.id"
                @toggle-open="store.togglePageOpen(page.id)"
            />

            <PageSubpage
                class="mt-0.5"
                :children="page.children"
                :open="page.open"
                v-if="Object.keys(page.children).length > 0"
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
