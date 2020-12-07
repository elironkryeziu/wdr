<template>
    <div class="py-4">
        <p class="text-center font-semibold text-sm">
            ©
            <span>{{date.getFullYear() }}</span>
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            date: new Date()
        }
    }
}
</script>

<style>

</style>