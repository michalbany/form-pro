<script setup>
import { ref, defineProps, onMounted } from "vue";
import Page from "./Page.vue";
import { useProjectStore } from "@/Store/projectStore";
import { usePage } from "@inertiajs/vue3";

const store = useProjectStore();
const subPages = ref(null);

const props = defineProps({
    index: String,
});

// V tenhle moment budeme načítat subpages
onMounted(() => {
    const subpagesData = usePage().props.subpages[props.index];
    if (subpagesData && subpagesData.length !== 0) {
        subPages.value = subpagesData;
    }
});

</script>

<template>
    <ul class="flex pl-6 flex-col gap-0.5 relative :pseudo-line">


        <li v-if="subPages" v-for="(page, index) in subPages" :key="page.id">
            <Page
                :page="page"
                :active="store.activePage === page.id ? true : false"
            />

            <PageSubpage
                class="mt-0.5"
                v-if="store.openPages.includes(page.id)"
                :index="index"
            />
        </li>


        <li v-else>
            <p class="text-sm text-gray-500 px-3 py-1 italic">
                No pages inside
            </p>
        </li>
    </ul>
</template>

<style>
.\:pseudo-line::before {
    content: "";
    position: absolute;
    bottom: 5px;
    top: 5px;
    left: 0px;
    width: 1px;
    border-radius: 5px;
    height: auto;
    background-color: #e4e3e3;
}
</style>
