<template>
    <modal name="new-lead-source-modal" height="auto" classes="p-5 card rounded-lg">
        <h1 class="class mx-auto font-semibold text-gray-700 text-lg text-center w-full">Add New Lead Source</h1>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <label for="name" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-1">Name</label>

                <input type="text"
                       id="name"
                       name="name"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.name ? 'border-red-500' : 'border-gray-500'"
                       placeholder="Macchu Picchu Re-enactment Event"
                       v-model="form.name"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.name" v-text="form.errors.name[0]"></span>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('new-lead-source-modal')">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from '../CrmForm'

    export default {
        name: "new-lead-source",

        props: ["company"],

        data() {
            return {
                form: new CrmForm({
                    name: '',
                    company_id: 1
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/lead-sources')
                    .then(response => {
                        this.flash(response.data.message);
                    });

                this.addLeadSource();

                this.hideModal();
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.$modal.hide('new-lead-source-modal');

                this.form.reset();
            },

            addLeadSource() {
                Event.fire('leadSourceAdded', {
                    date: moment().format('MMM D, YYYY'),
                    name: this.form.name
                })
            }
        }
    }
</script>

<style scoped>

</style>
