<template>
    <div>
        <br>
        <div class="ui right aligned">
            <div class="alert alert-danger" v-if="error">
                <p>There was an error, unable to sign in with those credentials.</p>
            </div>
            <div class="mt-3">
                <form autocomplete="off" @submit.prevent="login" method="post"> <!-- v-on:submit.prevent -->
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <div class="inline field">
                        <div class="ui toggle checkbox">
                        <input type="checkbox" tabindex="0" class="hidden">
                        <label>Remember me</label>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo: {
        title: 'Login Page',
    },
    data() {
        return {
            email: null,
            password: null,
            error: false,
        }
    },
    methods: {
        login() {
            var app = this
            this.$auth.login({
                params: {
                    email: app.email,
                    password: app.password,
                },
                success: function() {},
                error: function(e) {
                    app.error = true
                    app.errors = e.response.data.errors
                },
                rememberMe: true,
                redirect: '/',
                fetchUser: true,
            })
        }
    }
}
</script>

<style>

</style>
