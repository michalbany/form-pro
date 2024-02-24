import { defineStore } from 'pinia'
import { usePage } from '@inertiajs/vue3'

/**
 * V této komponentě potřebuju udělat to, že kdykoliv uživatel otevře nový
 * projekt, tak se nahraje jeho obsah sem. Tak aby obsahoval všechny stránky a podstránky
 * a všechny informace, které jsou důležité. Bude se zde udržovat stav projektu, tedy jeho aktuální úpravy.
 * A po Ctrl+S se to pošle na server nebo po uplynutí nějakého času nebo po provedení určitého počtu změn.
 * Tyto data jako lokální uložiště pro všechny komponenty, které s tímto projektem pracují. A musí být vždy aktuální tedy reaktivní.
 *
 * můžeme data ze serveru přidat i sem načítání i posílání dat na server
 */

/**
 * Mode 1 - editace
 * Mode 0 - View
 */

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        projectData: null,
        mode: true,
        pages: [],
    }),
    actions: {
        loadProjectData(projectData) {
            this.projectData = projectData;
        },
        loadPages(pages) {
            this.pages = pages;
        },
        toggleMode() {
            this.mode = ! this.mode;
        },
        getActiveMode() {
            return this.mode ? 'edit' : 'view';
        },
        setMode(mode) {
            this.mode = mode;
        },
        togglePageOpen(pageId, pages = this.pages) {
            Object.values(pages).forEach(page => {
                if (page.id === pageId) {
                    page.open = !page.open;
                }
                if (page.children && Object.keys(page.children).length > 0) {
                    this.togglePageOpen(pageId, page.children);
                }
            });
        },
    }


});
// export const useProjectStore = defineStore('projectStore', {
//     state: () => ({
//         project: null,
//         changesCount: 0,
//     }),
//     actions: {
//         // Načítání projektu do store z Inertia
//         loadProjekct() {
//             const editorData = usePage().props; // Načtení dat z Inertia
//             if (!this.project) {
//                 this.project = { ...editorData.project };
//             }
//             // Aktualizujeme stránky s respektem k existujícím hodnotám 'open'
//             this.project.pages = this.structureData(editorData.project.pages);
//             this.changesCount = 0;
//         },
//         // Struktura dat
//         stractureData(pages) {
//             const pagesWithOpen = pages.map(page => {
//                 const existingPage = this.findPageInStore(page.id);
//                 return {
//                     ...page,
//                     open: existingPage ? existingPage.open : false
//                 };
//             });
//             return pagesWithOpen;
//         },
//         // Hledání stránky v store
//         findPageInStore(id) {
//             // pomocí rekurzivní funkce najdeme stránku podle id
//             const findPage = (pages, id) => pages.find(page => page.id === id) ||
//                 pages.reduce((acc, page) => acc || findPage(page.subpages || [], id), null);

//             return this.project ? findPage(this.project.pages, id) : null;
//         },

//         // Přidání změn
//         makeChange() {
//             // potřeboval bych, že když posílám data do komponent z loadProject,
//             // tak aby byly reaktivní a automaticky, když se mění v komponentně aby se
//             // měnily i tady



//             this.changesCount++;
//             // Podmínka pro automatické ukládání
//             if (this.changesCount >= 10) { // Nebo neuběhly 2 minut od poslední změny
//                 this.saveProject();
//             }
//         },
//         // Uložení projektu
//         saveProject() {
//             console.log('Ukládám projekt...');
//             this.changesCount = 0;
//         },
//     }
// })