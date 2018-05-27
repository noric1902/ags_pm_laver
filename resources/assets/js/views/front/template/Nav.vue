<template>
    <div class="ui menu">
        <!-- <div class="header item">AGS</div> -->
        <div id="show-sidebar" class="menu header">
            <a class="item">
                <i class="sidebar icon"></i> AGS
            </a>
        </div>
        <router-link :to="{ name: 'home' }" class="item">Dashboard</router-link>
        <router-link :to="{ name: 'manual' }" class="item">Manual</router-link>
        <a class="item">About this App</a>
        <div class="right menu">
            <div class="item">
            <div class="ui action left icon input">
                <i class="search icon"></i>
                <input type="text" placeholder="Search">
                <button class="ui button">Submit</button>
            </div>
            </div>
            <div class="ui dropdown item" tabindex="0">
                <span v-if="!$auth.check()">Login/Register</span> <span v-if="$auth.check()">{{$auth.user().name}}</span>
                <i class="dropdown icon"></i>
                <div class="left menu transition hidden" tabindex="-1">
                    <router-link :to="{ name: 'login' }">
                        <span v-if="this.$route.path !== '/login'">
                            <a class="item" href="" v-if="!$auth.check()">
                                Login
                            </a>
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'register' }" v-if="!$auth.check()">
                        <a href="" class="item" v-if="this.$route.path !== '/register'">
                                Register
                        </a>
                    </router-link>
                    <a class="item" v-if="$auth.check()" @click.prevent="$auth.logout()">
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- sidebar -->
        <div v-if="$auth.check()">
            <div class="ui left inverted vertical menu sidebar">
                <router-link :to="{ name: 'site' }" class="item">Site Management</router-link>
                <router-link :to="{ name: 'submission' }" class="item">Submission</router-link>
                <router-link :to="{ name: 'project' }" class="item">Project Management</router-link>
                <router-link :to="{ name: 'job' }" class="item">Job Management</router-link>
                <router-link :to="{ name: 'progress' }" class="item">Progress Management</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
