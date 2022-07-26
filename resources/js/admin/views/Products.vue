<template>
    <div>
        <button class="btn btn-primary" @click="adding = !adding">Add Product</button>
        <form class="mt-3" :class="{'d-none': !adding}" @submit.prevent="save">
            <div class="mb-3">
                <input type="text" class="form-control" v-model="product.name" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" v-model="product.content" placeholder="Content"></textarea>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" min="0" v-model="product.price" placeholder="Price">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="published" v-model="product.is_published">
                <label class="form-check-label" for="published">
                    Published
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <table class="table mt-4" v-if="products.length">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="pr in products">
                <td valign="middle">
                    {{ pr.name }}
                </td>
                <td valign="middle">
                    {{ pr.price }}
                </td>
                <td>
                    <span class="w-100 d-flex justify-content-end">
                        <router-link :to="{name: 'edit-product', params: {id: pr.id}}" class="ms-2 btn btn-primary">Edit</router-link>
                        <button :class="`btn btn-${pr.is_published ? 'warning' : 'success'}`"
                                class="publish-btn ms-2" @click="publish(pr.id, !pr.is_published)">
                            {{ pr.is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                        <button class="ms-2 btn btn-danger delete-btn" @click="remove(pr.id)">Delete</button>
                    </span>
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
            adding: false,
            product: {
                name: '',
                content: '',
                price: 0,
                is_published: false,
            },
            products: [],
        }
    },
    async mounted() {
        const res = await axios.get('/admin/products');
        this.products = res.data.products;
    },
    methods: {
        async save()
        {
            const res = await axios.post(
                `/admin/products`,
                this.product
            );

            this.products.unshift(res.data.product);
        },
        async remove(id)
        {

        },
        async publish(id, value = true)
        {

        }
    }
}
</script>

<style scoped>

</style>
