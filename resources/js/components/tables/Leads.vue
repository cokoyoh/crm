<template>
    <div>
        <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
            <tbody>
                <tr
                    v-for="lead in items"
                    class="border border-gray-300 px-2 h-16 cursor-default"
                    :class="{'bg-white' : lead.id % 2 == 0, 'hover:bg-gray-200 cursor-pointer' : lead.viewable }"
                    @click="view(lead)"
                >
                <td class="pl-0">
                    <span v-if="lead.class_slug == 'not_followed_up'" class="badge-default lead-not-followed-up">Not Followed Up</span>
                    <span v-if="lead.class_slug == 'followed_up'" class="badge-default lead-followed-up">Followed Up</span>
                    <span v-if="lead.class_slug == 'converted'" class="badge-default lead-converted font-semibold">Converted</span>
                    <span v-if="lead.class_slug == 'lost'" class="badge-default lead-lost">Lost</span>
                    <span v-if="lead.class_slug == 'not_interested'" class="badge-default lead-not-interested">Not Interested</span>
                </td>
                <td class="text-sm text-gray-600 font-medium">{{lead.date}}</td>
                <td class="text-sm text-gray-600 font-normal">
                    <div class="w-full flex items-center pl-3">
                        <svg class="h-3 w-3 mr-2 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M20 18.35V19a1 1 0 0 1-1 1h-2A17 17 0 0 1 0 3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 0 1 .99 1v3.35z"/>
                        </svg>
                        {{lead.phone}}
                    </div>
                </td>
                <td class="text-sm text-gray-600 font-normal">
                    {{lead.email}}
                </td>
                <td class="leading-snug">
                    <p class="text-xs text-gray-600 font-semibold">{{lead.source}}</p>
                    <p class="text-gray-700 text-sm font-semibold">{{lead.name}}</p>
                </td>
                <td class="pr-2">
                    <dropdown>
                        <template v-slot:trigger>
                            <button
                                class="focus:outline-none rounded-full bg-transparent  ml-3 hover:bg-gray-100 active:bg-gray-200"
                            >
                                <svg class="h-5 w-5 fill-current text-gray-200"
                                     :class="{'text-gray-500' : actionable(lead)}"
                                     viewBox="0 0 24 24">
                                    <path d="M10 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0-6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                </svg>
                            </button>
                        </template>

                        <li class="dropdown-menu-item"
                            v-if="lead.assignable"
                            @click="reassign(lead.id)">
                            <a href="#">Reassign</a>
                        </li>
                    </dropdown>

                </td>
            </tr>
            </tbody>
        </table>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="There are no leads recorded yet"
        ></empty>

        <reassign-lead></reassign-lead>
    </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'

    export default {
        name: "leads",

        mixins: [ItemsRetrieval],

        props: ['api'],

        created() {
            //component mounted
        },

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

            reassign(leadId) {
                Event.fire('reassign-lead', leadId);

                this.$modal.show('reassign-lead-modal')
            },

            actionable(lead) {
                return lead.assignable || lead.viewable;
            },

            view(lead) {
                if (lead.viewable) {
                    location.href = '/leads/' + lead.id + '/show';
                }
            }
        }
    }
</script>

<style scoped>

</style>
