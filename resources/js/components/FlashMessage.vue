<template>
    <div class="text-white absolute bg-green-900 absolute rounded-lg top-0 lg:top-0 right-0 px-1 pt-2 pb-3 mt-16 mr-10" v-show="show">
        <div class="float-right px-1 py-1 bg-transparent">
            <svg
                @click="cancel"
                class="h-3 w-3 fill-current text-gray-600 rounded-full hover:text-gray-300 active:text-white"
                 viewBox="0 0 20 20">
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/>
            </svg>
        </div>

        <div class="flex items-center justify-between px-4 py-3">
            <svg class="h-6 w-6 fill-current font-bold text-white mr-1" viewBox="0 0 20 20">
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
            </svg>
           <p class="font-medium">{{message}}</p>
        </div>

    </div>
</template>

<script>
    export default {
        name: "flash-message",

        data() {
            return {
                show: false,
                message: 'hocus pocus, you\'ve lost your focus'
            }
        },

        updated() {
            this.hide();
        },

        methods: {
            flash(message) {
                this.message = message;

                this.show = true;
            },

            hide() {
                setInterval(() => {
                    this.show = false
                }, 10000);
            },

            cancel() {
                this.show = false;
            }
        },

        mounted() {
            Event.listen('flash-message', message => this.flash(message))
        }
    }
</script>

<style scoped>

</style>
