import './bootstrap';
import {createApp} from 'vue';
import {createRouter, createWebHashHistory} from 'vue-router';
import Categories from "./admin/views/Categories.vue";
import Products from "./admin/views/Products.vue";
import Main from "./admin/views/Main.vue";
import EditProduct from "./admin/views/EditProduct.vue";

const routes = [
    {
        path: '/',
        component: Main,
    },
    {
        path: '/categories',
        component: Categories,
        name: 'categories'
    },
    {
        path: '/products',
        component: Products,
        name: 'products'
    },
    {
        path: '/edit-product/:id',
        component: EditProduct,
        name: 'edit-product'
    },
];

import Panel from "./admin/Panel.vue";

const router = createRouter({
        history: createWebHashHistory(),
        routes,
    }),
    app = createApp(Panel);

app.use(router);
app.mount('#app');
