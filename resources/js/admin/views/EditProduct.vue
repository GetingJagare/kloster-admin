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
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "EditProduct"
}
</script>

<style scoped>

</style>
