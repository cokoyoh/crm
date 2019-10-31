<template>
    <modal name="new-schedule-modal" height="auto" classes="p-5 card rounded-lg">
        <p>Add Schedule</p>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
            <div class="mb-4">
                <label for="date" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-1">Date</label>

                <input type="date" id="date" name="date"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.date ? 'border-red-500' : 'border-gray-500'"
                       :placeholder="form.date"
                       v-model="form.date"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.date" v-text="form.errors.date[0]"></span>
            </div>

            <div class="mb-6">
                <label for="start_at" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider">Start</label>

                <input type="time" id="start_at" name="start_at"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.start_at ? 'border-red-500' : 'border-gray-500'"
                       :placeholder="form.start_at"
                       v-model="form.start_at"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.start_at" v-text="form.errors.start_at[0]"></span>
            </div>

            <div class="mb-6">
                <label for="end_at" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider">End</label>

                <input type="time" id="end_at" name="end_at"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.end_at ? 'border-red-500' : 'border-gray-500'"
                       :placeholder="form.end_at"
                       v-model="form.end_at"
                >
                <span class="text-xs italic text-red-700" v-if="form.errors.end_at" v-text="form.errors.end_at[0]"></span>
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
                    lead_id: 1
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/schedules')
                    .then(response => {
                        this.flash(response.data.message);

                        this.hideModal();
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
