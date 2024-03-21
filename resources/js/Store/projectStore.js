import { defineStore } from 'pinia'

/**
 * Store bude uchovávat inicializační data Editoru
 */

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        projectData: null,
        mode: true,
        parentPages: [],
        openPages: [],
    }),
    actions: {
        // @works: Potřebujeme uchovávat inicializační data pro editor
        loadProjectData(projectData) {
            this.projectData = projectData;
        },
        loadPages(parentPages) {
            this.parentPages = parentPages;
        },

        togglePage(pageId) {
            this.openPages = this.openPages.includes(pageId) ? this.openPages.filter(id => id !== pageId) : [...this.openPages, pageId];
        },




        // @review
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