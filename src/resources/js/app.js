

require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {ZiggyVue} from "ziggy/vue";
import {Ziggy} from "@/ziggy";

const el = document.getElementById('app');

const app = createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            //.mixin({ methods: { route } })
            .use(plugin)
            //.use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

// Add route helper to vue
//app.config.globalProperties.$route = (...args) => route(...args);

InertiaProgress.init({ color: '#4B5563' });
