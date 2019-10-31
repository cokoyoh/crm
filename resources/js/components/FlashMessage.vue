<template>
    <div
        v-show="show"
        class="flex items-center justify-between text-white bg-green-900 py-5 px-12
        absolute rounded-lg mx-auto font-bold top-0 lg:top-0 right-0 mr-10 mt-16">
        <svg class="h-5 w-5 fill-current text-white" viewBox="0 0 20 20">
            <path
                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0
                1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
        </svg>
        <p class="ml-2">{{message}}</p>
    </div>
</template>

<script>
    export default {
        name: "flash-message",

        data() {
            return {
                show: false,
                message: 'Some random message'
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
                setInterval(() => {this.show = false}, 6000);
            }
        },

        mounted() {
            Event.$on('flash-message', message => this.flash(message))
        }
    }
</script>

<style scoped>

</style>
