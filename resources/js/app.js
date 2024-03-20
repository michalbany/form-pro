import 'boxicons';
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPinia } from 'pinia';

const appName = import.meta.env.VITE_APP_NAME || 'Formense';

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        
        // @works: Přidáváme plugin pro BoxIcons
        app.component('box-icon', 'box-icon');

        app.use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .mount(el);

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
