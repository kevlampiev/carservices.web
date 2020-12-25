const Hello = () => import('./components/Hello')
const Home = () =>   import('./components/Home')
const Carservice = () => import('./components/Carservice')

const appRoutes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/service/:id',
        name: 'service',
        component: Carservice,
    },
    {
        path: '/hello',
        name: 'hello',
        component: Hello,
    },
]

export {appRoutes}

