<template>
    <div>
         <ul class="flex items-center justify-between w-3/4 mx-auto border rounded" role="tablist">
             <li
                 v-for="(tab, index) in tabs"
                 class="px-8 py-2 text-gray-700 border-l text-center"
                 :class="{ 'bg-blue-600 rounded' : tab.isActive}"
             >
<!--                 :style="tab.isActive ? 'margin-bottom: -1px' : ''"-->
                 <button
                     v-text="tab.title"
                     :class="{ 'font-bold text-white' : tab.isActive }"
                     class="focus:outline-none font-medium text-sm"
                     role="tab"
                     :aria-selected="tab.isActive"
                     @click="activeTab = tab"></button>
             </li>
         </ul>

        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "tabs",

        data() {
            return {
                tabs: [],
                activeTab: null
            }
        },

        mounted() {
            this.tabs = this.$children;

            this.setInitialActiveTab();
        },

        updated() {
            Event.listen('change-active-tab', tabTitle => {
                this.activeTab = this.tabs.find(tab => tab.title == tabTitle);
            })
        },

        watch: {
            activeTab(activeTab) {
                this.tabs.map(tab => (tab.isActive = tab == activeTab));
            }
        },

        methods: {
            setInitialActiveTab() {
                this.activeTab = this.tabs.find(tab => tab.active) || this.tabs[0];
            }
        }
    }
</script>

<style scoped>

</style>
