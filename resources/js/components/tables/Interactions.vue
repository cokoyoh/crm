<template>
    <div>
        <div  v-for="interaction in items"
            class="py-2 px-3 rounded-lg bg-white mt-3 text-gray-700 border border-gray-200">
            <div class="-ml-3 mb-2 border-l-4 border-green-400 pl-4 flex items-center">
                <svg
                    class="h-8 w-8 ml-1 p-1 rounded-full fill-current bg-gray-200 hover:bg-gray-300 hover:text-gray-700 ml-1 p-1 rounded-full text-gray-700"
                    viewBox="0 0 20 20">
                    <path
                        d="M20 18.35V19a1 1 0 0 1-1 1h-2A17 17 0 0 1 0 3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 0 1 .99 1v3.35z"/>
                </svg>

                <div class="flex-1 ml-2 sm:ml-8 items-center block">
                    <p class="leading-relaxed text-sm">
                        {{interaction.body}}
                    </p>

                    <div class="flex items-center text-xs mt-3">
                        <svg class="h-3 w-3 fill-current mr-2" viewBox="0 0 20 20">
                            <path
                                d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/>
                        </svg>
                        <span class="text-gray-600">{{interaction.date}} at {{interaction.time}}</span>
                    </div>
                </div>

                <button
                    @click="deleteInteraction(interaction)"
                    type="submit"
                    class="outline-none focus:outline-none">
                    <svg class="btn-delete"
                         viewBox="0 0 20 20">
                        <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                    </svg>
                </button>
            </div>
        </div>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no interactions recorded for this lead yet"
        ></empty>
    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'

    export default {
        name: "interactions",

        mixins: [ItemsRetrieval],

        props: ['lead'],

        created() {
            Event.listen('delete-interaction', (interactionId => this.removeItem(interactionId)) )
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                return '/api/leads/' + this.lead + "/interactions" + "?page=" + page;
            },

            deleteInteraction(interaction) {
                axios.delete('/interactions/' + interaction.id + '/destroy')
                    .then(response => {
                        this.flash(response.data.message);

                        Event.fire('delete-interaction', interaction);

                        this.removeItem(interaction);
                    })
                    .catch(error => this.error())
            },

            flash(message) {
                Event.fire('flash-message', message);
            },


            error() {
                Event.fire('flash-error', 'Interaction not deleted. Error occurred!');
            },

            removeItem(interaction) {
                //remove the item
                location.href = location.pathname;
            }
        }
    }
</script>

<style scoped>

</style>
