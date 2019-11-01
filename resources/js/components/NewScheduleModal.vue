<template>
    <modal name="new-schedule-modal" height="auto" classes="px-5 pt-10 pb-16 mb-4 card rounded-lg">
        <p class="text-2xl text-center text-gray-700 font-medium">Add Schedule</p>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <vue-date-picker
                    v-model="form.date"
                    format="YYYY-MM-DD"
                    formatted="YYYY-MM-DD"
                    label="Select Date"
                    aria-required="true"
                    no-header
                    auto-close
                    input-size="sm"
                    only-date
                    no-shortcuts
                    button-now-translation
                ></vue-date-picker>

                <span class="text-xs italic text-red-700" v-if="form.errors.date" v-text="form.errors.date[0]"></span>
            </div>

            <div class="mb-6">
                <vue-date-picker
                    v-model="form.start_at"
                    format="H:mm"
                    formatted="H:mm"
                    label="Start At"
                    no-header
                    input-size="sm"
                    only-time
                    no-shortcuts
                    minute-interval="5"
                ></vue-date-picker>
                <span class="text-xs italic text-red-700" v-if="form.errors.start_at" v-text="form.errors.start_at[0]"></span>
            </div>

            <div class="mb-6">
                <vue-date-picker
                    v-model="form.end_at"
                    format="H:mm"
                    formatted="H:mm"
                    label="End At"
                    no-header
                    input-size="sm"
                    only-time
                    no-shortcuts
                    minute-interval="5"
                ></vue-date-picker>
                <span class="text-xs italic text-red-700" v-if="form.errors.end_at" v-text="form.errors.end_at[0]"></span>
            </div>

            <div class="mb-6">
                <v-select
                    class="text-sm text-gray-700 mb-5 focus:border-blue-300"
                    :class="form.errors.lead_id ? 'border-red-500' : 'border-gray-500'"
                    :reduce="lead => lead.id"
                    v-model="form.lead_id"
                    @search="fetchLeads"
                    :options="options"
                    :filterable="false"
                    label="name"
                    value="id"
                    placeholder="Select lead"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.lead_id" v-text="form.errors.lead_id[0]"></span>
                </v-select>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('new-schedule-modal')">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from './CrmForm'

    export default {
        name: "new-schedule-module",

        data() {
            return {
                form: new CrmForm({
                    date: '2019-10-31',
                    start_at: '20:30',
                    end_at: '21:00',
                    lead_id: ''
                }),

                options: [],

                loading: false
            }
        },

        methods: {
            submit() {
                this.form.submit('/schedules')
                    .then(response => {
                        this.flash(response.data.message);

                        this.hideModal();
                    })
                    .catch(() => Event.fire('error-message', 'Error occurred. Schedule not saved!!'))
            },

            fetchLeads(searchString) {
                if (searchString.length >= 3) {
                    this.search(searchString);
                }
            },

            search(searchString) {
                axios.get(`/get-leads?query=${escape(searchString)}`)
                    .then(response => {
                        this.options = response.data;
                    })
            },


            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.$modal.hide('new-schedule-modal');

                this.form.reset();
            }
        }
    }
</script>

<style scoped>

</style>
