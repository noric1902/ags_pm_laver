const routes = [
    {
        path: '/',
        name: 'home',
        component: require('../views/front/dashboard/Index.vue'),
        meta: {
            auth: true
        }
    },
    { path: '/login', name: 'login', component: frontRequire('auth/Login'), },
    { path: '/register', name: 'register', component: frontRequire('auth/Register'), },
    { path: '/manual', name: 'manual', component: frontRequire('dashboard/Manual'), },
    { path: '/about', name: 'about', component: frontRequire('dashboard/About'), },
    { path: '/site', name: 'site', component: frontRequire('components/Site') },
    { path: '/project', name: 'project', component: frontRequire('components/Project') },
    { path: '/job', name: 'job', component: frontRequire('components/Job') },
    { path: '/submission', name: 'submission', component: frontRequire('components/Submission') },
    { path: '/progress', name: 'progress', component: frontRequire('components/Progress') },
]

function frontRequire($component) {
    return require('../views/front/' + $component + '.vue')
}

export default routes