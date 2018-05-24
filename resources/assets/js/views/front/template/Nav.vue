<template>
    <div class="ui menu">
    <div class="header item">AGS</div>
    <a class="active item">Dashboard</a>
    <a class="item">User Guide</a>
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
            User
            <i class="dropdown icon"></i>
            <div class="left menu transition hidden" tabindex="-1">
                <a class="item" href="">
                    Login
                </a>
                <a class="item" v-if="$auth.check()" @click.prevent="$auth.logout()">
                    Logout
                </a>
            </div>
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
