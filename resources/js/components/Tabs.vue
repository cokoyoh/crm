<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "tabs",

        methods: {
            setActive(name) {
                console.log(name)
            }
        }
    }
</script>

<style scoped>

</style>
