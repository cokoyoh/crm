require('./bootstrap');

import VModal from 'vue-js-modal'
import VueTelInput from "vue-tel-input";

Vue.use(VModal);
Vue.use(VueTelInput);

import "./components"

window.Event = new Vue();

const app = new Vue({
    el: '#app',
});
