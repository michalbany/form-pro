<script setup>
import { ref } from "vue";
import ToolbarButton from "@/Components/TextEditorButton.vue";
import { reactive } from "vue";
import EditorModel from "@/lib/EditorModel";
import { onMounted } from "vue";
import { onUnmounted } from "vue";


const props = defineProps({
    content: Array,
});

const editorRef = ref(null);

function setEditorRef(el) {
    editorRef.value = el;
}

const selectedLayout = ref([]);
const selectedFormats = ref([]);

onMounted(() => {
    document.addEventListener("selectionchange", getAllSelectedClasses);
});

onUnmounted(() => {
    document.removeEventListener("selectionchange", getAllSelectedClasses);
});

// Inicializace editoru
const editorModel = reactive(new EditorModel(props.content));

function format(style) {
    // @todo: Pokud se content v blocku není cely znamená to, že uživatel vybral text i z bloku za, budeme se tedy dívat do dalších bloků tak dlouho dokud nebudeme mít kompletní string
    const { text, range, blockIndex, contentIndex, editor } = getSelectedText();

    // pokud se jedná o globální styl bloku pouze provedeme toggleStyle
    
    if (text && range) {
        if (style === "text-center" || style === "text-left" || style === "text-right") {
            editorModel.toggleStyle(blockIndex, null, style);
        }
        // pokud se obsah rovna nemusíme rozdělovat bloky a hned aplikovat styly
        const textContent = editorModel.findText(blockIndex, contentIndex);

        if (textContent.trim() === text.trim()) {
            console.log("Text is equal to content")
            editorModel.toggleStyle(blockIndex, contentIndex, style, editor);
        } else if (textContent.includes(text)) {
            // Pokud text v bloku obsahuje cely vybrany text tak to znamena že uživatel vybral text z jednoho bloku
            console.log("Text is in one block")
            // Musíme block rozdělit na více contentů funkce by měla vracet pozici nového contentu
            const newIndex = editorModel.parseContent(blockIndex, contentIndex, range);
            editorModel.toggleStyle(blockIndex, newIndex, style, editor)
        } else {
            // Uživatel vybral text z více bloků   
            console.log("Text is in multiple blocks")
            // Musíme najít všechny bloky a contenty které obsahují vybraný text a sloučit je do jednoho contentu
            const newIndex = editorModel.mergeContents(blockIndex, contentIndex, range, text);
            editorModel.toggleStyle(blockIndex, newIndex, style, editor)
        }
    }
}


// 2 funkce pro zjišťování aktivní formátování
function getAllSelectedClasses() {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const editor = editorRef.value;

        if (editor.contains(range.commonAncestorContainer) || editor.contains(range.startContainer)) {
            // Získání všech elementů uvnitř rozsahu výběru
            const elements = getElementsWithinRange(range, editor);
            const selectedClasses = new Set(); // Používáme Set pro uchování unikátních hodnot
            const layoutFormat = []

            const layout = elements[0].childNodes[0].classList;
            layout.forEach(className => layoutFormat.push(className));

            elements.forEach(element => {
                if (element.tagName === "SPAN") {
                    element.classList.forEach(className => selectedClasses.add(className));
                }
            });

            selectedFormats.value = Array.from(selectedClasses);
            selectedLayout.value = Array.from(layoutFormat);
        }
    }
}

function getElementsWithinRange(range, container) {
    const elements = [];
    const treeWalker = document.createTreeWalker(container, NodeFilter.SHOW_ELEMENT);

    while (treeWalker.nextNode()) {
        const currentNode = treeWalker.currentNode;
        // Pokud je element částečně nebo plně uvnitř rozsahu, přidáme ho
        if (range.intersectsNode(currentNode)) {
            elements.push(currentNode);
        }
    }

    return elements;
}


function getSelectedText() {
    if (!editorRef.value)
        return { text: "", range: null, blockIndex: null, contentIndex: null };

    const selection = window.getSelection();

    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const editor = editorRef.value; // získáme editor

        // získání data atributů z elementu
        const startNode = range.startContainer.parentNode;
        const endNode = range.endContainer.parentNode;
        const blockIndex = startNode.dataset.blockIndex === endNode.dataset.blockIndex ? startNode.dataset.blockIndex : null;
        const contentIndex = startNode.dataset.contentIndex;

        // Kromě ošetření že se jedná o výběr v editoru potřebujeme vědět zda jsme vybrali pouze 1 blok
        if (editor.contains(range.commonAncestorContainer) && blockIndex !== null) {
            // Výběr je uvnitř editoru

            // Zde zjistíme jaké jsou selectnuté classes

            return {
                text: selection.toString(),
                range,
                blockIndex: blockIndex ? parseInt(blockIndex, 10) : null,
                contentIndex: contentIndex ? parseInt(contentIndex, 10) : null,
                editor
            };
        }
    }

    return { text: "", range: null, blockIndex: null, contentIndex: null };
}


</script>

<template>
    <!-- Tool Bar -->
    <div class="flex gap-4">
        <div class="flex gap-1">
            <ToolbarButton @click="format('heading')" icon="heading" title="heading" />
        </div>
        <div class="flex gap-1">
            <ToolbarButton :selected="selectedFormats.includes('bold')" @click="format('bold')" icon="bold" title="bold" />
            <ToolbarButton :selected="selectedFormats.includes('italic')" @click="format('italic')" icon="italic" title="italic" />
            <ToolbarButton :selected="selectedFormats.includes('underline')" @click="format('underline')" icon="underline" title="underline" />
            <ToolbarButton :selected="selectedFormats.includes('strikethrough')" @click="format('strikethrough')" icon="strikethrough" title="strikethrough" />
            <ToolbarButton :selected="selectedFormats.includes('text-blue-500')" @click="format('text-blue-500')" icon="font-color" title="color" />
        </div>

        <div class="flex gap-1">
            <ToolbarButton :selected="selectedLayout.includes('text-left')" @click="format('text-left')" icon="align-left" title="align-left" />
            <ToolbarButton :selected="selectedLayout.includes('text-center')" @click="format('text-center')" icon="align-middle" title="align-middle" />
            <ToolbarButton :selected="selectedLayout.includes('text-right')" @click="format('text-right')" icon="align-right" title="align-right" />
        </div>
    </div>
    <!-- Content with Text -->
    <div :ref="setEditorRef" contenteditable="true" @input="handleInput">

        <div v-for="(block, blockIndex) in editorModel.blocks" :key="blockIndex">
            <p v-if="block.type === 'paragraph'" :class="block.styles">
                <template v-for="(content, contentIndex) in block.content" :key="contentIndex">
                    <span :class="content.styles" :data-block-index="blockIndex" :data-content-index="contentIndex">
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
