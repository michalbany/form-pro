import { defineStore } from 'pinia'
import { usePage } from '@inertiajs/vue3'

/**
 * Store bude uchovávat inicializační data Editoru
 */

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        projectData: null,
        mode: true,
        parentPages: [],
    }),
    actions: {
        // @works: Potřebujeme uchovávat inicializační data pro editor
        loadProjectData(projectData) {
            this.projectData = projectData;
        },
        loadPages(parentPages) {
            this.parentPages = parentPages;
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