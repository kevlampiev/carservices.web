import Hello from './components/Hello'
import Home from './components/Home'
// import Register from './components/Register'
import Carservice from "./components/Carservice";

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

