require('./bootstrap');

import { createApp } from 'vue';
import App from './vue/App.vue'

(async function(){
    await navigator.serviceWorker.register("js/sw.js");

    createApp(App).mount('#app');
})();