<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { watchEffect, ref } from "vue";
import { defineAsyncComponent } from 'vue';


// Dynamické načtení komponent aby se načítaly pouze ty, které jsou potřeba
const componentsMap = {
  TextAreaComponent: defineAsyncComponent(() => import('./Partials/TextAreaComponent.vue')),
  ImageComponent: defineAsyncComponent(() => import('./Partials/ImageComponent.vue')),
  HeaderComponent: defineAsyncComponent(() => import('./Partials/HeaderComponent.vue')),
};


const pageData = ref(null);
const components = ref(null);
watchEffect(() => {
    const { page, content } = usePage().props.pageData
    pageData.value = page
    components.value = content
})

/**
 * Seskupíme komponenty do skupin podle group_id
 * @explain: Pozice ovlivňuje i pozici v group
 */
const groupComponents = computed(() => {
    const groups = [];
    const groupMap = {};

    // První krok: Seskupení a sběr komponent
    components.value.forEach((component) => {
        const groupId = component.group_id ? `group:${component.group_id}` : `ungrouped:${component.id}`;

        if (!groupMap[groupId]) {
            groupMap[groupId] = {
                groupId: groupId,
                components: [],
            };
            groups.push(groupMap[groupId]);
        }
        groupMap[groupId].components.push(component);
    });

    // Druhý krok: Seřazení komponent uvnitř každé skupiny podle position
    for (const group of Object.values(groupMap)) {
        group.components.sort((a, b) => a.position - b.position);
    }

    // Třetí krok: Seřazení skupin podle position první komponenty v každé skupině
    // To zahrnuje i 'ungrouped' komponenty, jelikož každá taková komponenta je vlastní "skupinou"
    groups.sort((a, b) => a.components[0].position - b.components[0].position);

    return groups;
});

</script>

<template>
    <main class="px-12">
        <section class="mt-6">
            <h1 class="block w-full text-3xl">{{ pageData.name }}</h1>
        </section>

        <section>
            <template v-for="group in groupComponents" :key="group.groupId">
                <div :class="{ 'flex gap-5 w-full justify-between': group.groupId.startsWith('group:') }">
                    <div v-for="component in group.components" :key="component.id" class="flex-1 mt-4">
                        <component :is="componentsMap[component.type]" :component="component"/>
                    </div>
                </div>
            </template>


        </section>

    </main>
</template>