<template>
    <div class="row">
        <div class="col-2">
            <div class="mb-3">
                <router-link :to="{name: 'categories'}">Categories</router-link>
            </div>
            <div>
                <router-link :to="{name: 'products'}">Products</router-link>
            </div>
        </div>
        <div class="col-10">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "Panel"
}
</script>

<style scoped>

</style>
