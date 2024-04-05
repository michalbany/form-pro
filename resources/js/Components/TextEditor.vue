<script setup>
import { ref } from 'vue';
import ToolbarButton from '@/Components/TextEditorButton.vue'


const props = defineProps({
    content: String
})

const contentRef = ref(props.content);

function format(type) {
    const contentElement = contentRef.value;
}

const selected = false;

</script>

<template>

    <!-- Tool Bar -->
    <div class="flex gap-4">
        <div class="flex gap-1">
            <ToolbarButton :selected="selected" @click="format('heading')" icon="heading" title="heading"/>
        </div>
        <div class="flex gap-1">
            <ToolbarButton :selected="selected" @click="format('bold')" icon="bold" title="bold"/>
            <ToolbarButton :selected="selected" @click="format('italic')" icon="italic" title="italic"/>
            <ToolbarButton :selected="selected" @click="format('underline')" icon="underline" title="underline"/>
            <ToolbarButton :selected="selected" @click="format('strikethrough')" icon="strikethrough" title="strikethrough"/>
            <ToolbarButton :selected="selected" @click="format('color')" icon="font-color" title="color"/>
        </div>

        <div class="flex gap-1">
            <ToolbarButton :selected="selected" @click="format('align-left')" icon="align-left" title="align-left"/>
            <ToolbarButton :selected="selected" @click="format('align-middle')" icon="align-middle" title="align-middle"/>
            <ToolbarButton :selected="selected" @click="format('align-right')" icon="align-right" title="align-right"/>
        </div>
        
    </div>
    <!-- Content with Text -->
    <div ref="contentRef" contenteditable="true" v-html="content">
    </div>
</template>
