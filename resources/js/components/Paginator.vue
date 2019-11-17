<template>
    <ul
        class="mt-2 flex items-center text-sm text-gray-700 font-medium"
        v-show="shouldPaginate"
    >
        <li
            v-show="prevUrl"
            class="flex items-center border border-gray-400 rounded py-1 px-2 hover:bg-gray-300 active:bg-gray-400 active:text-gray-900"
        >
            <span>
                <svg
                    class="h-4 w-4 fill-current"
                    viewBox="0 0 20 20">
                    <path d="M7.05 9.293L6.343 10 12 15.657l1.414-1.414L9.172 10l4.242-4.243L12 4.343z"/>
                </svg>
            </span>
            <a href="#" class="" rel="previous">Previous</a>
        </li>

        <li
            v-show="nextUrl"
            class="ml-2 flex items-center border border-gray-400 rounded py-1 px-2 hover:bg-gray-300 active:bg-gray-400 active:text-gray-900"
        >
            <a href="#" class="" rel="next">Next</a>
            <span>
                <svg
                    class="h-4 w-4 fill-current"
                    viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                </svg>
            </span>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "paginator",

        prop: ['dataSet'],

        data() {
            return {
                prevUrl: false,
                nextUrl: false,
                page: 2,
            }
        },

        computed: {
            shouldPaginate() {
                return this.prevUrl || this.nextUrl;
            }
        },

        watch: {
            dataSet() {
                this.updateDataSet();
            }
        },

        methods: {
            updateDataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            }
        }
    }
</script>

<style scoped>

</style>
