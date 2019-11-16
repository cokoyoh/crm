<template>
     <div>
         <table class="rounded-b-lg table-auto w-full bg-gray-100">
             <tbody>
             <tr v-for="leadSource in items"
                 class="border border-gray-300 px-2 h-16"
                 :class="{'bg-white' : leadSource.id % 2 == 0 }"
             >
                 <td class="pl-5 text-sm text-gray-600 font-medium"> {{ leadSource.date }}</td>
                 <td class="text-md text-gray-700 font-normal">{{  leadSource.name }}
                 <td>
                     <button
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
         
         <empty
             v-show="items.length < 1"
             message="There are no lead sources recorded yet"
         ></empty>
     </div>
</template>

<script>
    export default {
        name: "crm-table",
        props: {
          company: Number
        },

        data() {
            return {
                dataSet: false,
                items: [],
                endpoint: location.pathname,
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(){
                axios.get(this.url())
                    .then(this.refresh)
            },

            url() {
                return 'api' + location.pathname + "/" + this.company;
            },

            refresh({data}) {
                this.dataSet = data;

                this.items = data.data;

                console.log(this.dataSet);

                console.log(this.items);
            }
        }
    }
</script>

<style scoped>

</style>
