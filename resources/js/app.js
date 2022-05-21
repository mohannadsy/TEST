require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { i18nVue } from 'laravel-vue-i18n';
import { createApp } from 'vue'
import i18n from './i18n'

// createApp(App).use(i18n).use(i18n).mount('#app')

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(i18nVue, {
                lang: 'ar',
                resolve: lang =>
                    import (`../../lang/${lang}.json`),
            })
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
