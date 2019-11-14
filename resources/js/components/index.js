window.Vue = require('vue');

import Tabs from '../components/Tabs'
import Tab from '../components/Tab'
import NewLeadModal from '../components/NewLeadModal'
import LeadForm from '../components/LeadForm'
import FlashMessage from '../components/FlashMessage'
import ErrorMessage from '../components/ErrorMessage'
import NewScheduleModule from '../components/NewScheduleModal'
import NewInteractionModal from './NewInteractionModal'
import VueDatePicker from  'vue-ctk-date-time-picker'
import VueSelect from 'vue-select'
import Dropdown from '../components/Dropdown'
import Empty from '../components/Empty'



Vue.component('tabs', Tabs);
Vue.component('tab', Tab);
Vue.component('flash-message', FlashMessage);
Vue.component('error-message', ErrorMessage);
Vue.component('new-schedule-modal', NewScheduleModule);
Vue.component('new-interaction-modal', NewInteractionModal);
Vue.component('new-lead-modal', NewLeadModal);
Vue.component('vue-date-picker', VueDatePicker);
Vue.component('v-select', VueSelect);
Vue.component('dropdown', Dropdown);
Vue.component('lead-form', LeadForm);
Vue.component('empty', Empty);
