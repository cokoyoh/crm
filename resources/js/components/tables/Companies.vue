<template>
    <div class="mb-5">
        <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
            <tbody>
            <tr
                v-for="company in items"
                class="border border-gray-300 px-2 h-16"
                :class="{'bg-white' : company.id % 2 == 0 }"
            >
                <td class="pl-4">
                    <span v-if="company.status == 'Active'" class="badge-default badge-default-success">Active</span>
                    <span v-if="company.status == 'Inactive'" class="badge-default lead-lost">Inactive</span>
                    <span v-if="company.status == 'Unverified'" class="badge-default badge-default-indigo">Unverified</span>
                </td>
                <td class="text-sm text-gray-600 font-normal">{{company.date}}</td>
                <td class="leading-snug">
                    <p class="uppercase text-xs text-gray-600 font-semibold">{{company.name}}</p>
                    <p class="text-gray-700 text-sm font-semibold">{{company.email}}</p>
                </td>
                <td class="leading-snug">
                    <p class="uppercase text-xs text-gray-600 font-normal">{{company.admin_name}}</p>
                    <p class="text-gray-700 text-sm font-normal">{{company.admin_email}}</p>
                </td>

                <td>
                    <span class="bg-gray-300 rounded-full py-1 px-2 text-xs text-gray-700 font-medium">
                        {{company.users_count}}
                    </span>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no companies recorded yet"
        ></empty>
    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'

    export default {
        name: "companies",

        mixins: [ItemsRetrieval],

        created() {
            //component mounted
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                return 'api/companies' + '?page=' + page;
            },
        }
    }
</script>

<style scoped>

</style>
