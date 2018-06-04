import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import routes from './routes'
import NProgress from 'nprogress'
import Meta from 'vue-meta'
import Vuelidate from 'vuelidate'
import VuejsDialog from 'vuejs-dialog'
import BootstrapVue from 'bootstrap-vue'
// import VueResource from 'vue-resource'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(NProgress)
Vue.use(Meta)
Vue.use(Vuelidate)
Vue.use(VuejsDialog)
Vue.use(BootstrapVue)
// Vue.use(VueResource)

Vue.prototype.$api = 'api/v1/'
// Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken
// axios.defaults.headers.common = {
//     'X-CSRF-TOKEN': window.Laravel.csrfToken,
//     'X-Requested-With': 'XMLHTTPRequest',
// }

Vue.component('navbar', require('../views/front/template/Nav.vue'))
Vue.component('loading', require('vue-spinner/src/BeatLoader.vue'))

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
    next()
})

router.afterEach((to, from) => {
    NProgress.done()
})

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

export default router