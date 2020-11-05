import Hello from './components/Hello'
import Home from './components/Home'
import Register from './components/Register'
import Login from './components/Login'
import Carservice from "./components/Carservice";

const appRoutes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/service',
        name: 'service',
        component: Carservice,
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

