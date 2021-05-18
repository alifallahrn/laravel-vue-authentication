import Home from './components/Home.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'

export default {
    mode: 'history',
    base: '/',
    fallback: true,
    routes: [
        {
            path: '/',
            component: Home,
            name: Home
        },
        {
            path: '/login',
            component: Login,
            name: Login
        },
        {
            path: '/register',
            component: Register,
            name: Register
        }
    ]
}
