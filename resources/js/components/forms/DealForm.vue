<template>
    <modal name="deal-form-modal" height="auto" classes="p-5 card rounded-lg">
        <h1 class="class mx-auto font-semibold text-gray-700 text-lg text-center w-full">Add New Deal</h1>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <label for="name"
                       class="block uppercase tracking-wide text-gray-800 text-xs font-semibold mb-2">Name</label>

                <input type="text" id="name" name="name"
                       v-model="form.name"
                       class="appearance-none block w-full bg-white text-gray-900  border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 placeholder-gray-500"
                       placeholder="Three elongated crabs"
                       autocomplete="no"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.name"
                      v-text="form.errors.name[0]"></span>
            </div>

            <div class="mb-4">
                <label for="amount"
                       class="block uppercase tracking-wide text-gray-800 text-xs font-semibold mb-2">Amount</label>

                <input type="number" id="amount" name="amount"
                       v-model="form.amount"
                       class="appearance-none block w-full bg-white text-gray-900 placeholder-gray-500  border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       placeholder="300000"
                       autocomplete="no"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.amount"
                      v-text="form.errors.amount[0]"></span>
            </div>

            <div class="mb-4">
                <label class="label text-gray-800 font-semibold uppercase text-xs tracking-wider mb-1">Client</label>

                <v-select
                    class="text-sm text-gray-700 mb-5 focus:border-blue-300"
                    :class="form.errors.contact_id ? 'border-red-500' : 'border-gray-500'"
                    :reduce="contact => contact.id"
                    v-model="form.contact_id"
                    @search="fetchContacts"
                    :options="contacts"
                    :filterable="false"
                    label="name"
                    value="id"
                    placeholder="Select client"
                >
                    <span class="text-xs italic text-red-700" v-if="form.errors.contact_id" v-text="form.errors.contact_id[0]"></span>
                </v-select>
            </div>

            <div class="mb-4">
                <label class="label text-gray-800 font-semibold uppercase text-xs tracking-wider mb-1">Product</label>

                <v-select
                    class="text-sm text-gray-700 mb-5 focus:border-blue-300"
                    :class="form.errors.product_id ? 'border-red-500' : 'border-gray-500'"
                    :reduce="product => product.id"
                    v-model="form.product_id"
                    @search="fetchProducts"
                    :options="products"
                    :filterable="false"
                    label="name"
                    value="id"
                    placeholder="Select product"
                >
                    <span class="text-xs italic text-red-700" v-if="form.errors.product_id" v-text="form.errors.product_id[0]"></span>
                </v-select>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('deal-form-modal')">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from '../CrmForm'

    export default {
        name: "deal-form",

        data() {
            return {
                form: new CrmForm({
                    name: '',
                    amount: null,
                    contact_id: '',
                    product_id: '',
                }),

                contacts: [],

                products: [],
            }
        },

        methods: {
            submit() {
                this.form.submit('/deals')
                    .then(response => {
                        this.flash(response.data.message);

                        this.addDeal(response.data.deal);

                        this.hideModal();
                    })
                    .catch(() => Event.fire('error-message', 'Error occurred. Deal not added!!'))
            },

            fetchContacts(searchString) {
                if (searchString.length >= 3) {
                    this.search(searchString, `/get-user-contacts?query=${escape(searchString)}`, 'contacts');
                }
            },

            fetchProducts(searchString) {
                if (searchString.length >= 3) {
                    this.search(searchString, `/get-company-products?query=${escape(searchString)}`, 'products');
                }
            },

            search(searchString, url, type) {
                axios.get(url)
                    .then(response => {
                        this[type] = response.data;
                    })
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.$modal.hide('deal-form-modal');

                this.form.reset();
            },

            addDeal(deal) {
                Event.fire('itemAdded', deal)
            }
        }
    }
</script>

<style scoped>

</style>
