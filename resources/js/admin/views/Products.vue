<template>
    <div>

    </div>
</template>

<script>
export default {
    name: "Products",
    data() {
        return {
            products: [],
        }
    },
    async mounted() {
        const res = await axios.get('/admin/products');
        this.products = res.data.products;
    }
}
</script>

<style scoped>

</style>
