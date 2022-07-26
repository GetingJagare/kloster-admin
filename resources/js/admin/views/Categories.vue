<template>
    <div>
        <button class="btn btn-primary" @click="adding = !adding">Add Category</button>
        <form class="mt-3" :class="{'d-none': !adding}" @submit.prevent="save">
            <div class="d-flex">
                <input type="text" class="form-control" id="name" v-model="name" required placeholder="Name">
                <button type="submit" class="btn btn-primary ms-3">Save</button>
            </div>
        </form>
        <table class="table mt-4" v-if="categories.length">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="cat in categories">
                <td valign="middle">{{cat.name}}</td>
                <td><button class="btn btn-danger delete-btn" @click="remove(cat.id)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Categories",
    data() {
        return {
            adding: false,
            name: '',
            categories: [],
        }
    },
    async mounted() {
        const res = await axios.get('/admin/categories');
        this.categories = res.data.categories;
    },
    methods: {
        async save() {
            const res = await axios.post(
                '/admin/categories',
                {
                    name: this.name,
                },
            );
            this.categories.unshift(res.data.category);
            this.name = '';
            this.adding = false;
        },

        async remove(id)
        {
            await axios.delete(`/admin/categories/${id}`);

            const index = this.categories.findIndex((c) => c.id === id);
            this.categories.splice(index, 1);
        }
    }
}
</script>

<style scoped>
.delete-btn {
    float: right;
}
</style>
