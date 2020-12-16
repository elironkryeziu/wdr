<template>
  <div>
    <div class="tabs">
        <ul class="flex flex-col sm:flex-row">
            <li v-for="tab in tabs" :class="{ 'is-active text-white': tab.isActive }"  :key="tab.id" class="py-2 px-1">
                <a :href="tab.href" 
                    @click="selectTab(tab)" 
                    :class="{ 'is-active bg-gray-700 text-white rounded-md': tab.isActive }" 
                    class="px-2 py-2 font-semibold hover:bg-gray-700 text-gray-400 rounded-md">
                {{ tab.name }}
                </a>
            </li>
        </ul>
    </div>

    <div class="tabs-details">
        <slot></slot>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            tabs: []
        }
    },
    created() {
        
        this.tabs = this.$children;
        
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });
        }
    }
}
</script>

<style>

</style>