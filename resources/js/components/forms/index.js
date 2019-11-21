window.Vue = require('vue');

import NewLeadSourceModal from "./NewLeadSourceModal";
import ReassignLead from "./ReassignLead";
import LeadForm from "./LeadForm";
import ProductForm from "./ProductForm";

Vue.component('new-lead-source', NewLeadSourceModal);
Vue.component('reassign-lead', ReassignLead);
Vue.component('lead-form', LeadForm);
Vue.component('product-form', ProductForm);
