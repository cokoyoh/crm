window.Vue = require('vue');

import LeadSources from "./LeadSources";
import Leads from "./Leads";
import Interactions from "./Interactions";
import Users from "./Users";
import Companies from "./Companies";
import Products from "./Products";
import Deals from "./Deals";

Vue.component('lead-sources', LeadSources);
Vue.component('leads', Leads);
Vue.component('interactions', Interactions);
Vue.component('users', Users);
Vue.component('companies', Companies);
Vue.component('products', Products);
Vue.component('deals', Deals);
