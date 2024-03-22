<script setup>
import { usePage } from "@inertiajs/vue3";
import { dateForHumans } from "@/lib/helpers"
import { formatDateTime } from "@/lib/helpers"


const { project } = usePage().props.initData;
console.log(project)



</script>

<template>
    <main class="px-12">
        <section class="mt-6">
            <h1 class="block w-full text-3xl">{{ project.name }}</h1>
        </section>

        <section class="mt-6">
            <div class="flex">
                <box-icon type="solid" name='message-square-add' />
                <span>Created at: {{ formatDateTime(project.created_at) }}</span>
            </div>
            <div class="flex">
                <box-icon type="solid" name="pencil"/>
                <span>Last edited: {{ dateForHumans(project.updated_at) }}</span>
            </div>
        </section>

        <section>
            <p class="text-gray-600 mt-4">
                Zde bude možnost vygenerovat klíč pro klienta + zobrazit lidi,
                kteří na projektu pracují.
            </p>
        </section>
    </main>
</template>
