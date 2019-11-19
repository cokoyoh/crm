<script>
    export default {
        name: "session-flash",

        data() {
            return {
                show: true
            }
        },

        methods: {
            close() {
                this.show = false;
            }
        }
    }
</script>

<style scoped>

</style>
