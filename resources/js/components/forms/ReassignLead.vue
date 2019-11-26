<template>
    <modal name="reassign-lead-modal" height="auto" classes="p-5 card rounded-lg">
        <h1 class="class mx-auto font-semibold text-gray-700 text-lg text-center w-full">Reassign Lead</h1>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <label class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-1">Users</label>

                <v-select
                    class="text-sm text-gray-700 mb-5 focus:border-blue-300"
                    :class="form.errors.user_id ? 'border-red-500' : 'border-gray-500'"
                    :reduce="user => user.id"
                    v-model="form.user_id"
                    @search="fetchUsers"
                    :options="options"
                    :filterable="false"
                    label="name"
                    value="id"
                    placeholder="Select user"
                >
                    <span class="text-xs italic text-red-700" v-if="form.errors.user_id" v-text="form.errors.user_id[0]"></span>
                </v-select>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('reassign-lead-modal')">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from '../CrmForm'

    export default {
        name: "reassign-lead",

        data() {
            return {
                form: new CrmForm({
                    user_id: '',
                }),

                leadId: null,

                options: [],
            }
        },

        mounted() {
            Event.listen('reassign-lead', leadId => {
                this.leadId = leadId;
            });
        },

        methods: {
            submit() {
                this.form.submit('/leads/' + this.leadId + '/reassign')
                    .then(response => {
                        this.flash(response.data.message);

                        this.hideModal();

                        this.reload();
                    })
                    .catch((error) => {
                        console.log(error);
                        Event.fire('error-message', error.message)
                    })
            },

            fetchUsers(searchString) {
                if (searchString.length >= 3) {
                    this.search(searchString);
                }
            },

            search(searchString) {
                axios.get(`/get-company-users?query=${escape(searchString)}`)
                    .then(response => {
                        this.options = response.data;
                    })
            },

            reload() {
                // location.href = '/leads/' + this.lead + '/show';
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.$modal.hide('reassign-lead-modal');

                this.form.reset();
            }
        }
    }
</script>

<style scoped>

</style>
