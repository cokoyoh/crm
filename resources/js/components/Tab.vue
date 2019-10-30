<template>
    <div role="tabpanel" v-show="isActive" class="mt-8">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            title: {},
            active: {
                type: Boolean,
                default: false
            }
        },
        name: "tab",

        data() {
            return {
                isActive: this.active
            }
        }
    }
</script>

<style scoped>

</style>
