<template>
    <div class="bg-gray-100 px-24 py-10">
        <form @submit.prevent="submit">
            <div class="mb-6">
                <label for="name"
                       class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2">Name</label>

                <input type="text" id="name" name="name"
                       v-model="form.name"
                       class="appearance-none block w-full bg-white text-gray-900 placeholder-gray-600  border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                      placeholder="John Doe"
                       autocomplete="no"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.name"
                      v-text="form.errors.name[0]"></span>
            </div>

            <div class="mb-6">
                <label for="email"
                       class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2">Email</label>

                <input type="email" id="email" name="email"
                       v-model="form.email"
                       @blur="checkDuplicateEmails(form.email)"
                       @keydown="emailExists = null"
                       class="appearance-none block w-full bg-white text-gray-900 placeholder-gray-600  border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       placeholder="john@example.com"
                       autocomplete="no"
                >
                <span class="text-xs italic text-red-700"
                      v-if="form.errors.email"
                      v-text="form.errors.email[0]"></span>
                <span class="text-xs italic text-red-700 px-2" v-show="emailExists !== null" v-text="emailExists"></span>
            </div>


            <div class="mb-6 flex items-center justify-between">
                <div class="w-3/4">
                    <label for="email" class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2">Phone</label>

                    <vue-tel-input
                        inputClasses=""
                        wrapperClasses=""
                        defaultCountry="KE"
                        v-model="form.phone"
                        :dynamicPlaceholder="true"
                        :enabledCountryCode="true"
                        mode="international"
                        @blur="checkDuplicatePhone(form.phone)"
                    ></vue-tel-input>

                    <span class="text-xs italic text-red-700" v-if="form.errors.phone"
                          v-text="form.errors.phone[0]"></span>
                    <span class="text-xs italic text-red-700 px-2" v-show="phoneExists !== null" v-text="phoneExists"></span>
                </div>

                <div class="w-full ml-2">
                    <label for="email" class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2">Lead Source</label>

                    <v-select
                        class="text-gray-700 focus:border-gray-300"
                        :class="form.errors.lead_source_id ? 'border-red-500' : 'border-gray-500'"
                        :reduce="source => source.id"
                        v-model="form.lead_source_id"
                        @search="fetchSources"
                        :options="options"
                        :filterable="false"
                        label="name"
                        value="id"
                        placeholder="Select user"
                    >
                    </v-select>

                    <span class="text-xs italic text-red-700" v-if="form.errors.lead_source_id" v-text="form.errors.lead_source_id[0]"></span>
                </div>
            </div>

            <div class="block mb-6">
                <span class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2">Gender</span>
                <div class="mt-2 flex align-center justify-between">
                    <div v-for="gender in genders">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="radio" :value="gender.id" v-model="form.gender_id">
                            <span class="ml-2 text-gray-900">{{gender.name}}</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2"
                           for="address">
                        Address
                    </label>
                    <input
                        class="appearance-none block w-full bg-white  text-gray-900 placeholder-gray-500 border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="address"
                        type="text"
                        placeholder="221B Baker Street"
                        autocomplete="no"
                        v-model="form.address"
                    >
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2"
                           for="city">
                        City/State/Province
                    </label>
                    <div class="relative">
                        <input type="text" id="city" name="city"
                               v-model="form.city"
                               class="appearance-none block w-full bg-white  text-gray-900 placeholder-gray-500  border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               placeholder="Macchu Picchu"
                               autocomplete="no"
                        >
                        <span class="text-xs italic text-red-700" v-if="form.errors.city"
                              v-text="form.errors.city[0]"></span>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2"
                           for="zip_code">
                        Zip Code
                    </label>
                    <input
                        class="appearance-none block w-full bg-white text-gray-900 placeholder-gray-500 border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="zip_code"
                        type="text"
                        placeholder="90210"
                        autocomplete="no"
                        v-model="form.zip_code"
                    >
                    <span class="text-xs italic text-red-700" v-if="form.errors.zip_code"
                          v-text="form.errors.zip_code[0]"></span>
                </div>
            </div>
            <div class="mt-5 mb-5">
                <button
                    class="flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none"
                    v-show="enableButton(phoneExists, emailExists)"
                >
                    <span>Save Lead</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import CrmForm from '../CrmForm'

    export default {
        name: "lead-form",

        props: {
            company: {
                type: String,
                default: ''
            },
            genders: {
                type: Array,
                default: () => []
            }
        },

        data() {
            return {
                form: new CrmForm({
                    name: '',
                    email: '',
                    lead_source_id: '',
                    phone: '',
                    company_id: '',
                    gender_id: 1,
                    city: '',
                    zip_code: '',
                    address: ''
                }),
                emailExists: null,
                phoneExists: null,
                options: []
            }
        },

        mounted() {
            this.form.company_id = this.company;
        },

        methods: {
            submit() {
                this.form.submit('/leads')
                    .then(response => {
                        this.flash(response.data.message);

                        this.form.reset();
                    })
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            checkDuplicateEmails(email) {
                axios.get('/leads/check-email?email='+ email)
                    .then(response => {
                        this.emailExists = response.data.message;
                    })
                    .catch(error => this.flash(error))
            },

            checkDuplicatePhone(phone) {
                if (phone != null && phone.length > 3) {
                    axios.get('/leads/check-phone?phone=' + phone)
                        .then(response => {
                            this.phoneExists = response.data.message;
                        })
                        .catch(error => this.flash(error))
                }
            },

            enableButton(hasPhoneError = null, hasEmailError = null) {
                if (hasEmailError != null || hasEmailError != null) {
                    return false;
                }

                return  true;
            },

            fetchSources(searchString) {
                if (searchString.length >= 3) {
                    this.search(searchString);
                }
            },

            search(searchString) {
                axios.get(`/get-company-sources?query=${escape(searchString)}`)
                    .then(response => {
                        this.options = response.data;
                    })
            },
        }
    }
</script>

<style scoped>

</style>
