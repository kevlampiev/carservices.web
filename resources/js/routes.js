import Hello from './components/Hello'
import Home from './components/Home'
import Register from './components/Register'
import Login from './components/Login'

const appRoutes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/hello',
        name: 'hello',
        component: Hello,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    }
]

export {appRoutes}

