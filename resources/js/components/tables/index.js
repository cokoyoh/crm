window.Vue = require('vue');

import LeadSources from "./LeadSources";
import Leads from "./Leads";
import Interactions from "./Interactions";
import Users from "./Users";

Vue.component('lead-sources', LeadSources);
Vue.component('leads', Leads);
Vue.component('interactions', Interactions);
Vue.component('users', Users);
