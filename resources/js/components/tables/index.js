window.Vue = require('vue');

import LeadSources from "./LeadSources";
import Leads from "./Leads";
import Interactions from "./Interactions";

Vue.component('lead-sources', LeadSources);
Vue.component('leads', Leads);
Vue.component('interactions', Interactions);
