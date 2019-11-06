<template>
    <modal name="new-interaction-modal" height="auto" classes="p-5 card rounded-lg">
        <h1 class="class mx-auto font-semibold text-green-700 text-lg text-center w-full">Add Interaction</h1>

        <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">

            <div class="mb-4">
                <textarea type="text" id="body" name="body"
                       class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                       :class="form.errors.body ? 'border-red-500' : 'border-gray-500'"
                       v-model="form.body"
                       placeholder="Met with the lead over a cup of coffee..."
                      cols="30" rows="5"></textarea>
                <span class="text-xs italic text-red-700" v-if="form.errors.body" v-text="form.errors.body[0]"></span>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('new-interaction-modal')">Cancel</button>

                <button class="btn btn-success text-xs">Submit</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import CrmForm from './CrmForm'

    export default {
        name: "new-interaction-model",

        props: {
          lead: Number,
          user: Number,
        },

        data() {
            return {
                leadId: this.lead,

                form: new CrmForm({
                    body: '',
                    user_id: this.user
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/interactions/' + this.leadId + '/store')
                    .then(response => {
                        this.flash(response.data.message);

                        this.hideModal();

                        location.href = response.data.link;
                    });
            },

            flash(message) {
                Event.fire('flash-message', message);
            },

            hideModal() {
                this.$modal.hide('new-interaction-modal');

                this.form.reset();
            }
        }
    }
</script>

<style scoped>

</style>
