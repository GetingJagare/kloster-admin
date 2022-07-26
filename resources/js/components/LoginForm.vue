<template>
    <form class="login-form mx-auto" @submit.prevent="login">
        <div class="alert alert-danger" v-if="error">
            Wrong login or password
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Login</label>
            <input type="text" class="form-control" id="name" v-model="name" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
export default {
    name: "LoginForm",
    data() {
        return {
            error: false,
            name: '',
            password: '',
        }
    },
    methods: {
        async login() {
            const res = await axios.post(
                '/login',
                {
                    name: this.name,
                    password: this.password,
                }
            );

            this.error = !res.data.success;
            if (!this.error) {
                window.location.href = '/admin';
            }
        }
    }
}
</script>

<style scoped>
.login-form {
    max-width: 600px;
}
</style>
