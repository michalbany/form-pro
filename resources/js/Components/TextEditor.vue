<script setup>
import { ref } from "vue";
import ToolbarButton from "@/Components/TextEditorButton.vue";
import { reactive } from "vue";

// const editorModel = ref({
//     blocks: [
//         {
//             type: "paragraph",
//             content: [
//                 {
//                     text: "Hello World ",
//                     styles: {bold: true},
//                 },
//                 {
//                     text: "Hello World2",
//                     styles: {italic: true, strikethrough: true, 'text-red-400': true},
//                 },
//             ],
//             styles: {} //global paragraph style
//         },
//     ],
// });

const props = defineProps({
    content: Array,
});

const editorRef = ref(null);

function setEditorRef(el) {
    editorRef.value = el;
}

class EditorModel {
    constructor(blocks) {
        this.blocks = blocks;
    }

    parseBlock() {
        // Funkce pro zozdělení contentu v blocu na více contentů podle selection
    }

    findContent(blockIndex, contentIndex) {
        return this.blocks[blockIndex].content[contentIndex].text;
    }

    toggleStyle(blockIndex, contentIndex, style) {
        let path = "";

        if (contentIndex !== null) {
            path = this.blocks[blockIndex].content[contentIndex].styles;
            // Pokud styl už existuje smažeme ho
            if (path[style]) {
                delete path[style];
            } else {
                path[style] = true;
            }
        } else {
            // Pro blockstyles přepisujeme styly
            this.blocks[blockIndex].styles = { [style]: true }
        }

        console.log(this.blocks[blockIndex]);
    }

    // formatBlockContent(blockIndex, contentIndex, range, style) {
    //     // Najděte blok a content na základě indexů
    //     const block = this.blocks[blockIndex];
    //     if (!block) return;

    //     const contentPiece = block.content[contentIndex];
    //     if (!contentPiece) return;

    //     // Vypočítejte začátek a konec výběru uvnitř contentu
    //     const selectionStart = range.startOffset;
    //     const selectionEnd = range.endOffset;

    //     // Rozdělte text contentu podle výběru
    //     const beforeText = contentPiece.text.substring(0, selectionStart);
    //     const selectedText = contentPiece.text.substring(selectionStart, selectionEnd);
    //     const afterText = contentPiece.text.substring(selectionEnd);

    //     // Aktualizujte blok s novým rozdělením a stylem
    //     const newContents = [];
    //     if (beforeText) {
    //         newContents.push({ text: beforeText, styles: {} }); // Předpokládáme původní styly
    //     }
    //     newContents.push({ text: selectedText, styles: style }); // Přidáný styl
    //     if (afterText) {
    //         newContents.push({ text: afterText, styles: {} }); // Předpokládáme původní styly
    //     }

    //     // Nahraďte původní content nově rozdělenými částmi
    //     block.content.splice(contentIndex, 1, ...newContents);
    // }
}

const editorModel = reactive(new EditorModel(props.content));

function format(style) {
    // @todo: Pokud se content v blocku není cely znamená to, že uživatel vybral text i z bloku za, budeme se tedy dívat do dalších bloků tak dlouho dokud nebudeme mít kompletní string
    const { text, range, blockIndex, contentIndex } = getSelectedText();

    // pokud se jedná o globální styl bloku pouze provedeme toggleStyle
    if (
        style === "text-center" ||
        style === "text-left" ||
        style === "text-right"
    ) {
        editorModel.toggleStyle(blockIndex, null, style);
    }

    if (text && range) {
        console.log(editorModel.findContent(blockIndex, contentIndex));
        console.log(text);
        // pokud se obsah rovna nemusíme rozdělovat bloky a hned aplikovat styly
        if (
            editorModel.findContent(blockIndex, contentIndex).trim() ===
            text.trim()
        ) {
            editorModel.toggleStyle(blockIndex, contentIndex, style);
        }

        // editorModel.formatBlockContent(blockIndex, contentIndex, range, { [style]: true });
    }
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
        const blockIndex = startNode.dataset.blockIndex;
        const contentIndex = startNode.dataset.contentIndex;

        // console.log("block: " + blockIndex);
        // console.log("content:" + contentIndex);

        if (editor.contains(range.commonAncestorContainer)) {
            // Výběr je uvnitř editoru
            return {
                text: selection.toString(),
                range,
                blockIndex: blockIndex ? parseInt(blockIndex, 10) : null,
                contentIndex: contentIndex ? parseInt(contentIndex, 10) : null,
            };
        }
    }

    return { text: "", range: null, blockIndex: null, contentIndex: null };
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
                @click="format('text-left')"
                icon="align-left"
                title="align-left"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('text-center')"
                icon="align-middle"
                title="align-middle"
            />
            <ToolbarButton
                :selected="selected"
                @click="format('text-right')"
                icon="align-right"
                title="align-right"
            />
        </div>
    </div>
    <!-- Content with Text -->
    <div :ref="setEditorRef" contenteditable="true" @input="handleInput">
        <!-- {{ editorContent }} -->

        <div
            v-for="(block, blockIndex) in editorModel.blocks"
            :key="blockIndex"
        >
            <p v-if="block.type === 'paragraph'" :class="block.styles">
                <template
                    v-for="(content, contentIndex) in block.content"
                    :key="contentIndex"
                >
                    <span
                        :class="content.styles"
                        :data-block-index="blockIndex"
                        :data-content-index="contentIndex"
                    >
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
