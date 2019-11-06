<template>
    <div class="dropdown relative">
        <div class="dropdown-trigger" @click.prevent="isOpen = ! isOpen">
            <slot name="trigger"></slot>
        </div>

        <transition name="pop-out-quick">
            <ul
                class="dropdown-menu"
                v-show="isOpen"
                aria-haspopup="true"
                :aria-expanded="isOpen"
            >
                <slot></slot>
            </ul>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "dropdown",

        data() {
            return {
                isOpen: false
            }
        },

        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside)
                }
            }
        },

        methods: {
            closeIfClickedOutside(event) {
                if(! event.target.closest('.dropdown')) {
                    this.isOpen = false;
                }
            }
        }
    }
</script>

<style>
    .pop-out-quick-enter-active,
    .pop-out-quick-leave-active {
        transition: all 0.4s;
    }

    .pop-out-quick-enter,
    .pop-out-quick-leave-active {
        opacity: 0;
        transform: translateY(-7px)
    }

</style>
