<script setup>
import { ref } from "vue";
import ToolbarButton from "@/Components/TextEditorButton.vue";

const props = defineProps({
    content: String,
});

const editorRef = ref(null);

function setEditorRef(el) {
    editorRef.value = el;
}

const editorModel = ref({
    blocks: [
        {
            type: "paragraph",
            content: [
                {
                    text: "Hello World ",
                    styles: {bold: true},
                },
                {
                    text: "Hello World2",
                    styles: {italic: true, strikethrough: true, 'text-red-400': true},
                },
            ],
            styles: {} //global paragraph style
        },
    ],
});


function format(style) {
    // const contentElement = contentRef.value;
    const { text, range } = getSelectedText();
    if (text && range) {
        
        console.log(`Applying ${style} to selected text: ${text}`);
    }
}

function getSelectedText() {
  if (!editorRef.value) return { text: '', range: null };
  
  const selection = window.getSelection();

  if (selection.rangeCount > 0) {
    const range = selection.getRangeAt(0);
    const editor = editorRef.value;

    if (editor.contains(range.commonAncestorContainer)) {
      // Výběr je uvnitř editoru
      return {
        text: selection.toString(),
        range,
      };
    }
  }
  return { text: '', range: null };
}

function handleInput(e) {
    // převod vstupu uživatele na JSON model
}

const selected = false;
</script>

<template>
    <!-- Tool Bar -->
    <div class="flex gap-4">
        <div class="flex gap-1">
            <ToolbarButton
                :selected="selected"
                @click="format('heading')"
                icon="heading"
                title="heading"
            />
        </div>
        <div class="flex gap-1">
            <ToolbarButton
                :selected="selected"
                @click="format('bold')"
                icon="bold"
                title="bold"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('italic')"
                icon="italic"
                title="italic"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('underline')"
                icon="underline"
                title="underline"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('strikethrough')"
                icon="strikethrough"
                title="strikethrough"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('color')"
                icon="font-color"
                title="color"
            />
        </div>

        <div class="flex gap-1">
            <ToolbarButton
                :selected="selected"
                @click="format('align-left')"
                icon="align-left"
                title="align-left"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('align-middle')"
                icon="align-middle"
                title="align-middle"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('align-right')"
                icon="align-right"
                title="align-right"
            />
        </div>
    </div>
    <!-- Content with Text -->
    <div :ref="setEditorRef" contenteditable="true" @input="handleInput">
        <!-- {{ editorContent }} -->

        <div v-for="(block, index) in editorModel.blocks" :key="index">
            <p v-if="block.type === 'paragraph'">
                <template
                    v-for="(content, index) in block.content"
                    :key="index"
                >
                <span :class="content.styles">
                    {{ content.text }}
                </span>
                </template>
            </p>
            <!-- Zde můžete přidat další typy bloků -->
        </div>
    </div>
</template>

<style scoped>
.bold {
    font-weight: bold;
}

.italic {
    font-style: italic;
}

.underline {
  text-decoration: underline;
}

.strikethrough {
    text-decoration: line-through;
}
</style>
