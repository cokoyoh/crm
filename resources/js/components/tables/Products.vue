<template>
    <div>
        <table class="rounded-b-lg table-auto w-full bg-gray-100">
            <tbody>
            <tr v-for="(product, index) in items"
                class="border border-gray-300 px-2 h-16"
                :class="{'bg-white' : product.id % 2 == 0 }"
            >
                <td class="pl-5 text-sm text-gray-600 font-medium"> {{ product.date }}</td>
                <td class="text-md text-gray-700 font-normal">{{  product.name }}
                <td>
                    <button
                        @click="removeItem(index, product.id)"
                        type="submit"
                        class="outline-none focus:outline-none">
                        <svg class="btn-delete"
                             viewBox="0 0 20 20">
                            <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                        </svg>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no products recorded yet"
        ></empty>
    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'

    export default {
        name: "products",

        mixins: [ItemsRetrieval],

        created() {
            this.addItem();
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                return 'apis' + location.pathname + "?page=" + page;
            },

            addItem() {
                Event.listen('productAdded', product => this.items.unshift(product))
            },

            removeItem(index, id) {
                let endpoint = '/products/' + id;

                axios.delete(endpoint)
                    .then(response => {
                        this.items.splice(index, 1);

                        this.flash(response.data.message);
                    });
            },

            flash(message) {
                Event.fire('flash-message', message);
            },
        }
    }
</script>

<style scoped>

</style>
