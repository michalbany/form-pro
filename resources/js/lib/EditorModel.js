class EditorModel {
    constructor(blocks) {
        this.blocks = blocks;
    }

    parseContent(blockIndex, contentIndex, range) {
        // Funkce pro rozdělení contentu v bloku na více contentů podle selection
        // Vytvořte nový blok s novým contentem
        const contentPiece = this.blocks[blockIndex].content[contentIndex];
        const selectionStart = range.startOffset;
        const selectionEnd = range.endOffset;

        let newContentIndex = contentIndex;

        // Není možné aby byl content rozdělen na více než 3 části
        const beforeText = contentPiece.text.substring(0, selectionStart);
        const selectedText = contentPiece.text.substring(
            selectionStart,
            selectionEnd
        );
        const afterText = contentPiece.text.substring(selectionEnd);

        // Vytvoření nových contentů
        const newContents = [];
        if (beforeText) {
            newContents.push({
                text: beforeText,
                styles: { ...contentPiece.styles },
            });
            newContentIndex++;
        }

        newContents.push({
            text: selectedText,
            styles: { ...contentPiece.styles },
        });

        if (afterText) {
            newContents.push({
                text: afterText,
                styles: { ...contentPiece.styles },
            });
        }
        // Přidáme nové contenty do bloku a smažeme původní
        this.blocks[blockIndex].content.splice(contentIndex, 1, ...newContents);

        return newContentIndex;
    }

    mergeContents(blockIndex, contentIndex, range, text) {
        // Musíme najít všechny contents které obsahují vybraný text a sločit je do jednoho contentu

        const block = this.blocks[blockIndex];
        const startContentPiece = block.content[contentIndex];
        // selection offset v začínajícím contentu
        const selectionStart = range.startOffset;
        // selection offset v končícím contentu
        const selectionEnd = range.endOffset;

        let accumulatedText = startContentPiece.text.substring(
            selectionStart,
            startContentPiece.text.length
        );
        // let accumulatedStyles = {}

        let newContentIndex = contentIndex;
        let lastContentIndex = null;

        // Projdeme všechny contenty v bloku a najdeme ty které obsahují vybraný text
        for (let i = contentIndex; i < block.content.length; i++) {
            if (i !== contentIndex) {
                accumulatedText += block.content[i].text.substring(
                    0,
                    selectionEnd
                );
                lastContentIndex = i;
            }

            // Object.assign(accumulatedStyles, block.content[i].styles)

            if (accumulatedText === text) {
                break;
            } else {
                if (i !== contentIndex) {
                    accumulatedText += block.content[i].text.substring(
                        selectionEnd,
                        block.content[i].text.length
                    );
                }
            }
        }

        if (lastContentIndex !== null) {
            // zde upvení prvního a posledního contentu a přidání nového mezi ně (merchnutého) s tím, že smažeme všechny contenty mezi
            const newContents = [];

            const beforeText = startContentPiece.text.substring(
                0,
                selectionStart
            );
            const afterText = block.content[lastContentIndex].text.substring(
                selectionEnd,
                block.content[lastContentIndex].text.length
            );

            if (beforeText) {
                newContents.push({
                    text: beforeText,
                    styles: { ...startContentPiece.styles },
                });
                newContentIndex++;
            }

            newContents.push({ text: text, styles: {} }); // styly necháváme čisté

            if (afterText) {
                newContents.push({
                    text: afterText,
                    styles: { ...block.content[lastContentIndex].styles },
                });
            }

            // nahradíme contenty v původním rozsahu novými
            block.content.splice(
                contentIndex,
                lastContentIndex - contentIndex + 1,
                ...newContents
            );

            // window.getSelection().removeAllRanges();
            return newContentIndex;
        }
    }

    findStylesFromRange(blockIndex, contentIndex, range, text) {
        // Funkce pro nalezení stylů v daném rozsahu
        const block = this.blocks[blockIndex];
        const startContentPiece = block.content[contentIndex];
        const selectionStart = range.startOffset;
        const selectionEnd = range.endOffset;

        let accumulatedText = startContentPiece.text.substring(
            selectionStart,
            startContentPiece.text.length
        );
        let accumulatedStyles = { ...startContentPiece.styles };

        let lastContentIndex = null;

        for (let i = contentIndex; i < block.content.length; i++) {
            if (i !== contentIndex) {
                accumulatedText += block.content[i].text.substring(
                    0,
                    selectionEnd
                );
                Object.assign(accumulatedStyles, block.content[i].styles);
                lastContentIndex = i;
            }

            if (accumulatedText === text) {
                break;
            } else {
                if (i !== contentIndex) {
                    accumulatedText += block.content[i].text.substring(
                        selectionEnd,
                        block.content[i].text.length
                    );
                }
            }
        }

        return accumulatedStyles;
    }

    findText(blockIndex, contentIndex) {
        return this.blocks[blockIndex].content[contentIndex].text;
    }

    findContent(blockIndex, contentIndex) {
        return this.blocks[blockIndex].content[contentIndex];
    }

    toggleStyle(blockIndex, contentIndex, style, editorRef) {
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
            this.blocks[blockIndex].styles = { [style]: true };
        }

        // reset range pro aktualizaci UI -- ostraníme všechny range a selectneme editovany text
        this.selectTextByIndexes(blockIndex, contentIndex, editorRef);
    }

    // @todo: Znovu selectnou nový content
    selectTextByIndexes(blockIndex, contentIndex, editorRef) {
        if (!editorRef) return;

        // // Najděte element podle data atributů
        // const query = `[data-block-index="${blockIndex}"][data-content-index="${contentIndex}"]`;
        // const targetElement = editorRef.querySelector(query);

        // if (targetElement) {
        //     const range = document.createRange();
        //     const selection = window.getSelection();

        //     // Nastavení rozsahu na nalezený element
        //     range.selectNodeContents(targetElement);


            // @idea: Můžeme použít range.selectNode(targetElement)

        //     // Odstranění předchozích výběrů a přidání nového rozsahu
        //     selection.removeAllRanges();
        //     selection.addRange(range);
        // }

        window.getSelection().removeAllRanges();
    }
}

export default EditorModel;
