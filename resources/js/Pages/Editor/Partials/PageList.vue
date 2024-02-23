<script setup>
import { defineProps, defineEmits, reactive, watchEffect, computed } from "vue";
import PageSubpage from "./PageSubpage.vue";
import Page from "./Page.vue";
import { useProjectStore } from "@/Store/projectStore";

const store = useProjectStore();
const pages = reactive(store.pages);





</script>

<template>
    <ul class="flex flex-col gap-0.5">
        <li v-for="page in pages" :key="page.id">
            <Page
                :page="page"
            />

            <PageSubpage
                class="mt-0.5"
                v-if="Object.keys(page.children).length > 0"
                :children="page.children"
            />
        </li>
    </ul>
</template>
