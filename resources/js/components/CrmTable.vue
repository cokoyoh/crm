<template>
     <div>
         <slot></slot>
     </div>
</template>

<script>
    export default {
        name: "crm-table",

        data() {
            return {
                items: [],
                endpoint: location.pathname
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(){
                axios.get(this.url)
                    .then(this.refresh)
            },

            refresh(response) {

            }
        }
    }
</script>

<style scoped>

</style>
