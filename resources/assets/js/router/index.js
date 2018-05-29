import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import routes from './routes'
import NProgress from 'nprogress'
import Meta from 'vue-meta'
// import VueResource from 'vue-resource'
import '../../../../node_modules/nprogress/nprogress'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(NProgress)
Vue.use(Meta)
// Vue.use(VueResource)

Vue.prototype.$api = 'api/v1/'
// Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken
// axios.defaults.headers.common = {
//     'X-CSRF-TOKEN': window.Laravel.csrfToken,
//     'X-Requested-With': 'XMLHTTPRequest',
// }

Vue.component('navbar', require('../views/front/template/Nav.vue'))
Vue.component('pagination', require('laravel-vue-pagination'))

const router = new VueRouter({
    hashbang: false,
    mode: 'history',
    history: 'true',
    routes: routes,
    linkActiveClass: 'active',
})
router.mode = 'html5'

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/',
                query: { 
                    redirect: to.fullPath 
                }
            })
        }
    }
    NProgress.start()
    NProgress.set(0.1)
    next();
})

router.afterEach((to, from) => {
    setTimeout(() => NProgress.done(), 500)
})

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

export default router