/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import { createInertiaApp, Head, Link  } from '@inertiajs/inertia-vue'
import Vuetify from 'vuetify' // path to vuetify export
import 'vuetify/dist/vuetify.min.css'
//import axios from './axios';

//import { ZiggyVue } from 'ziggy';
//import { Ziggy } from './ziggy';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        // for using ziggy
        Vue.mixin({ methods: { route } });
        Vue.component('InertiaHead', Head)
        Vue.component('InertiaLink', Link)
        //Vue.use(ZiggyVue);
        //Vue.use(Ziggy);
        //
        Vue.use(plugin)
        Vue.use(Vuetify)

        new Vue({
            vuetify: new Vuetify({
                theme: { dark: false },
                icons: {
                    iconfont: 'mdiSvg', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
                },
            }),
            //axios,
            render: h => h(App, props),
        }).$mount(el)
    },
})

//  **************************************************************
//  **************************************************************
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/
