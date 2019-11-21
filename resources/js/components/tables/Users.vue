<template>
    <div>
        <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
            <tbody>
            <tr
                v-for="user in items"
                class="border border-gray-300 px-2 h-16"
                :class="{'bg-white' : user.id % 2 == 0 }"
            >
                <td class="pl-4">
                    <span v-if="user.status == 'Active'" class="badge-default lead-followed-up">Active</span>
                    <span v-if="user.status == 'Inactive'" class="badge-default lead-lost">Inactive</span>
                    <span v-if="user.status == 'Unverified'" class="badge-default lead-not-interested">Unverified</span>
                </td>
                <td class="text-sm text-gray-600 font-medium">{{user.date}}</td>
                <td class="text-sm text-gray-600 font-normal">
                    <div class="w-full flex items-center pl-3">
                        <svg class="h-3 w-3 mr-2 fill-current"
                             v-show="user.phone"
                             viewBox="0 0 20 20">
                            <path
                                d="M20 18.35V19a1 1 0 0 1-1 1h-2A17 17 0 0 1 0 3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 0 1 .99 1v3.35z"/>
                        </svg>
                        {{user.phone}}
                    </div>
                </td>
                <td class="text-sm text-gray-600 font-normal">
                    {{user.email}}
                </td>
                <td class="leading-snug">
                    <p class="uppercase text-xs text-gray-600 font-semibold">{{user.role}}</p>
                    <p class="text-gray-700 text-sm font-semibold">{{user.name}}</p>
                </td>
                <td class="pr-4">
<!--                    <a :href="'/users/' + user.id + '/show'">-->
                    <a href="#">
                        <button
                            type="submit"
                            class="outline-none focus:outline-none ">
                            <svg class="btn-delete"
                                 viewBox="0 0 20 20">
                                <path d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                            </svg>
                        </button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no users added yet"
        ></empty>
    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'

    export default {
        name: "leads",

        mixins: [ItemsRetrieval],

        props: ['user'],

        created() {
            //component mounted
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                return 'api' + location.pathname + "/" + this.user + "?page=" + page;
            },
        }
    }
</script>

<style scoped>

</style>
