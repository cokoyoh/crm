require('./bootstrap');

import VModal from 'vue-js-modal'

Vue.use(VModal);

import "./components"

const app = new Vue({
    el: '#app',
});
