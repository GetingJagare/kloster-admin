<template>
    <div>
        <h2>{{ `Edit product #${$route.params.id}` }}</h2>
        <form class="mt-3" @submit.prevent="save">
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
            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <select class="form-control" multiple id="categories" v-model="productCategories">
                    <option v-for="cat in categories" :value="cat.id">
                        {{ cat.name }}
                    </option>
                </select>
            </div>
            <div class="alert alert-danger" v-if="errorMessage">
                {{ errorMessage }}
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "EditProduct",
    data() {
        return {
            product: {},
            productCategories: [],
            categories: [],
            errorMessage: '',
        }
    },
    async mounted() {
        const res = await axios.get(`/admin/products/${this.$route.params.id}`);
        this.product = res.data.product;
        this.productCategories = res.data.product.categories.map((c) => c.id);
        this.categories = res.data.categories;
    },
    methods: {
        async save()
        {
            this.product.categories = this.productCategories;
            const res = await axios.put(`/admin/products/${this.product.id}`, this.product);
            if (!res.data.success) {
                this.errorMessage = res.data.message;
                return;
            }

            this.product = res.data.product;
            this.errorMessage = '';
        }
    }
}
</script>

<style scoped>

</style>
