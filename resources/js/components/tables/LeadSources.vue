<template>
     <div>
         <table class="rounded-b-lg table-auto w-full bg-gray-100">
             <tbody>
             <tr v-for="(leadSource, index) in items"
                 class="border border-gray-300 px-2 h-16"
                 :class="{'bg-white' : leadSource.id % 2 == 0 }"
             >
                 <td class="pl-5 text-sm text-gray-600 font-medium"> {{ leadSource.date }}</td>
                 <td class="text-md text-gray-700 font-normal">{{  leadSource.name }}
                 <td>
                     <button
                         @click="removeItem(index, leadSource.id)"
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
             message="There are no lead sources recorded yet"
         ></empty>
     </div>
</template>

<script>
    import ItemsRetrieval from '../../mixins/ItemsRetrieval'
    import Collection from "../../mixins/Collection";

    export default {
        name: "lead-sources",

        mixins: [ItemsRetrieval, Collection],

        props: {
          company: Number
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                return 'api' + location.pathname + "/" + this.company + "?page=" + page;
            },
        }
    }
</script>

<style scoped>

</style>
