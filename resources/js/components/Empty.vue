<template>
    <div
        v-show="isVisible"
        class="py-2 px-3 rounded-lg bg-white mt-8 text-gray-700 border border-gray-200"
    >
            <div class="-ml-3 border-l-4 border-green-400 pl-4 flex items-center">
                <svg
                    class="h-8 w-8 rounded-full fill-current bg-gray-200 hover:bg-gray-300 hover:text-gray-700 ml-1 p-2 rounded-full text-gray-700"
                    viewBox="0 0 20 20">
                    <path d="M2 2c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v18l-8-4-8 4V2zm2 0v15l6-3 6 3V2H4z"/>
                </svg>

                <div class="flex-1 ml-2 sm:ml-8 items-center block">
                    <p class="leading-relaxed text-sm">
                        {{message}}
                    </p>

                    <div class="flex items-center text-xs mt-3">
                        <svg class="h-3 w-3 fill-current mr-2" viewBox="0 0 20 20">
                            <path
                                d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/>
                        </svg>
                        <span class="text-gray-600">
                            {{date}}
                        </span>
                    </div>
                </div>

                <svg
                    @click="isVisible = false"
                    class="btn-delete mr-2"
                     viewBox="0 0 20 20">
                    <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                </svg>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['message'],
        name: "empty",

        data() {
            return {
                isVisible: true,
                date: ''
            }
        },

        mounted() {
            this.date = moment().format('MMM Do, YYYY [at] h:mm a');
        }
    }
</script>

<style scoped>

</style>
