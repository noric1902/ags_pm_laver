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
                    <div class="form-group field">
                        <label for="permission">Permission</label>
                        <select id="permission" class="form-control selectpicker" v-model="permission">
                            <option value="default">SELECT PERMISSION</option>
                            <option value="pic">PIC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="access_code">Access Code</label>
                        <input type="text" class="form-control" id="access_code" v-model="access_code">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo: {
        title: 'Register Page'
    },
    data() {
        return {
            email: null,
            password: null,
            permission: null,
            access_code: null,
            error: false,
            permission: 'default'
        }
    }
}
</script>

<style>

</style>
