const ownerPage = () => import('./components/OwnerPage')
const Home = () => import('./components/Home')
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
        path: '/owner',
        name: 'owner',
        component: ownerPage,
    },
]

export {appRoutes}

