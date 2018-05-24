import Vue from 'vue'
import VueRouter from 'vue-router'
// import VueResource from 'vue-resource'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)
// Vue.use(VueResource)
Vue.use(VueAxios, axios)

const routes = [
    {
        path: '/',
        name: 'home',
        component: require('../views/front/dashboard/index.vue'),
        meta: {
            auth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: frontRequire('auth/Login'),
    },
]

const router = new VueRouter({
    hashbang: false,
    mode: 'history', // remove hashtag from vue route url
    history: 'true',
    routes: routes,
    linkActiveClass: 'active'
})

router.mode = 'html5'

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        }
    }
    next();
})

function frontRequire($component) {
    return require('../views/front/' + $component + '.vue')
}

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

export default router