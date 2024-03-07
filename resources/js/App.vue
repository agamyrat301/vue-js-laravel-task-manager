<template>
    <div class="container mx-auto">
        <navbar/>
        <div class="p-3">
            <router-view />
        </div>

        <notifications />
    </div>
</template>

<script>


export default {
    name: "App",
}
</script>

<style scoped>

</style>
