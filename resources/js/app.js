import './bootstrap'
import './components'
import './components/Listener'
import VModal from 'vue-js-modal'
import VueTelInput from 'vue-tel-input'

Vue.use(VModal);
Vue.use(VueTelInput);

const app = new Vue({
    el: '#app',
});
