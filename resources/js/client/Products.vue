<template>
    <div>
        <table class="table mt-4" v-if="products.length">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Content</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="pr in products">
                <td valign="middle">
                    {{ pr.name }}
                </td>
                <td valign="middle">
                    {{ pr.content }}
                </td>
                <td valign="middle">
                    {{ pr.price }}
                </td>
            </tr>
            </tbody>
        </table>
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
        const res = await axios.get('/products');
        this.products = res.data.products;
    },
}
</script>

<style scoped>

</style>
