<template>
    <modal name="product-form-modal" height="auto" classes="p-5 card rounded-lg">
        <h1 class="class mx-auto font-semibold text-gray-700 text-lg text-center w-full">Add New Product</h1>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <label for="name" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-1">Name</label>

                <input type="text" id="name" name="name"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.name ? 'border-red-500' : 'border-gray-500'"
                       placeholder="Elongated Crabs"
                       v-model="form.name"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.name" v-text="form.errors.name[0]"></span>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="hideModal">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from '../CrmForm'

    export default {
        name: "product-form",

        props: {
            company: Number
        },

        data() {
            return {
                form: new CrmForm({
                    name: '',
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/products')
                    .then(response => {
                        this.flash(response.data.message);
                    });

                this.addProduct();

                this.hideModal();
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.form.reset();

                this.$modal.hide('product-form-modal');
            },

            addProduct() {
                Event.fire('productAdded', {
                    date: moment().format('MMM D, YYYY'),
                    name: this.form.name
                })
            }
        }
    }
</script>

<style scoped>

</style>
