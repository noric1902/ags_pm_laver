<template>
    <div>
        <navbar class="pusher"></navbar>
        <div class="container">
            <div class="content pusher">
                <transition name="fade" mode="out-in">
                    <router-view class="page" :key="$route.path"></router-view>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        metaInfo: {
            titleTemplate: '%s - AGS PM',
            meta: [
                // <meta charset="UTF-8">
                // <meta name="viewport" content="width=device-width, initial-scale=1.0">
                // <meta http-equiv="X-UA-Compatible" content="ie=edge">
                // <meta name="csrf-token" content="{{ csrf_token() }}">`
                { charset: 'utf-8' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1.0' },
                // { name="csrf-token", content: csrf_token() }
            ]
        },
    }
    
    // semantic
    $(function() {
        $('.ui.dropdown').dropdown();
        // $('.ui.checkbox').checkbox();
        $('#show-sidebar').click(function() {
            $('#show-sidebar').show();
            $('.menu.sidebar').sidebar('toggle');
        });
        
        $('#hide-sidebar').click(function() {
            $('#show-sidebar').show();
            $('.menu.sidebar').sidebar('toggle');
        });
    });

</script>

<style>

</style>
