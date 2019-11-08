<template>
    <div>
        <form @submit.prevent="submit" class="w-8/12 mx-auto py-5">
            <div class="mb-6">
                <label for="name"
                       class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>

                <input type="text" id="name" name="name"
                       v-model="form.name"
                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                      placeholder="John Doe">
                <span class="text-xs italic text-red-700" v-if="form.errors.name"
                      v-text="form.errors.name[0]"></span>
            </div>

            <div class="mb-6">
                <label for="email"
                       class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</label>

                <input type="email" id="email" name="email"
                       v-model="form.email"
                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       placeholder="John Doe">
                <span class="text-xs italic text-red-700" v-if="form.errors.email"
                      v-text="form.errors.email[0]"></span>
            </div>


            <div class="mb-6 flex items-center justify-between">

                <div class="flex items-center justify-between">
                    <label for="country_code" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone</label>
                    <input type="text" id="country_code" name="country_code"
                           class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           placeholder="+254"
                           v-model="form.country_code"
                    >
                    <span class="text-xs italic text-red-700" v-if="form.errors.country_code"
                          v-text="form.errors.country_code[0]"></span>
                </div>

                <div class="flex-1 ml-4">
                    <input type="text" id="phone_number" name="phone_number"
                           class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           placeholder="712 345 678"
                           v-model="form.phone_number"
                    >
                    <span class="text-xs italic text-red-700" v-if="form.errors.phone_number"
                          v-text="form.errors.phone_number[0]"></span>
                </div>
            </div>


            <div class="mb-6">
                <label for="name"
                       class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Gender</label>

                <div class="flex items-center">
                    <input type="radio" class="mr-5"> Male
                    <input type="radio"> Female
                </div>
            </div>

            <div class="inline-block relative w-full mb-6">
                <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Lead Source</label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="lead_source_id">
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <span class="text-xs italic text-red-700" v-if="form.errors.lead_source_id"
                      v-text="form.errors.lead_source_id[0]"></span>
            </div>


            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="address">
                        Address
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="address" type="text" placeholder="Albuquerque">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="state">
                        City/State/Province
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="state">
                            <option>New Mexico</option>
                            <option>Missouri</option>
                            <option>Texas</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="zip_code">
                        Zip Code
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="zip_code" type="text" placeholder="90210">
                </div>
            </div>
            <div class="mt-5 mb-5">
                <button type="submit" class="price-button w-1/4 text-gray-700">Save Lead</button>
                <a href="#">
                    <button class="ml-2 price-button w-1/4 text-gray-700">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</template>

<script>
    import CrmForm from './CrmForm'

    export default {
        name: "lead-form",

        data() {
            return {
                form: new CrmForm({
                    name: '',
                    email: '',
                    lead_source_id: '',
                    country_code: '',
                    phone_number: '',
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/leads')
                    .then(response => console.log(response))
            }
        }
    }
</script>

<style scoped>

</style>
