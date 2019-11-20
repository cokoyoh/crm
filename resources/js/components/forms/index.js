window.Vue = require('vue');

import NewLeadSourceModal from "./NewLeadSourceModal";
import ReassignLead from "./ReassignLead";
import LeadForm from "./LeadForm";

Vue.component('new-lead-source', NewLeadSourceModal);
Vue.component('reassign-lead', ReassignLead);
Vue.component('lead-form', LeadForm);
