import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

Vue.use(VueRouter)
Vue.use(VueResource)

const routes = [
    {
        path: '/',
        name: 'home',
        component: vueComponent('Home')
    },
    {
        path: '/login',
        name: 'login',
        component: vueComponent('auth/Login')
    }
]

const router = new VueRouter({
    history: true,
    routes: routes
})

function vueComponent($file) {
    return Vue.component($file, require('./components/' + $file + '.vue'))
}

new Vue(
    Vue.util.extend(
        {routes}
    )
).$mount('#app')