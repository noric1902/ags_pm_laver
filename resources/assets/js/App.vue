<template>
    <div>
        <navbar></navbar>
        <div class="containe">
            <div class="content">
                <transition name="fade" mode="out-in">
                    <router-view class="page" :key="$route.path"></router-view>
                </transition>
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
