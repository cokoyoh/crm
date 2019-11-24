<template>
    <div>
        <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
            <tbody>
            <tr
                v-for="deal in items"
                class="border border-gray-300 px-2 h-16 cursor-default"
                :class="{'bg-white' : deal.id % 2 == 0, 'hover:bg-gray-200 cursor-pointer' : deal.viewable }"
                @click="view(deal)"
            >
                <td class="pl-4">
                    <span v-if="deal.stage == 'pending'" class="badge-default lead-not-followed-up">Pending</span>
                    <span v-if="deal.stage == 'won'" class="badge-default lead-followed-up">Won</span>
                    <span v-if="deal.stage == 'won-and-verified'" class="badge-default lead-converted font-semibold">Won & Verified</span>
                    <span v-if="deal.stage == 'lost'" class="badge-default lead-lost">Lost</span>
                </td>
                <td class="text-sm text-gray-600 font-medium">{{deal.date}}</td>
                <td class="text-sm text-gray-600 font-normal">
                    <div class="w-full flex items-center pl-3">
                        {{deal.name}}
                    </div>
                </td>
                <td class="text-sm text-gray-600 font-normal">
                    {{deal.email}}
                </td>
                <td class="leading-snug">
                    <p class="text-xs text-gray-600 font-semibold">{{deal.product}}</p>
                    <p class="text-indigo-900 text-lg font-semibold">{{deal.amount}}</p>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no deals recorded yet"
        ></empty>

    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'
    import Collection from "../../mixins/Collection";

    export default {
        name: "deals",

        mixins: [ItemsRetrieval, Collection],

        props: ['api'],

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                if (this.api) {
                    return  this.api + "?page=" + page;
                }

                return 'apis' + location.pathname + "?page=" + page;
            },

            view(deal) {
                if (deal.viewable) {
                    location.href = '/deals/' + deal.id + '/show';
                }
            }
        }
    }
</script>

<style scoped>

</style>
