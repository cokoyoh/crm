window.Vue = require('vue');

import Tabs from '../components/Tabs'
import Tab from '../components/Tab'
import NewLeadModal from '../components/NewLeadModal'
import FlashMessage from '../components/FlashMessage'



Vue.component('tabs', Tabs);
Vue.component('tab', Tab);
Vue.component('new-lead-modal', NewLeadModal);
Vue.component('flash-message', FlashMessage);
