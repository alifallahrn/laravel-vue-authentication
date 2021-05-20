import Home from './components/Home.vue'
import Tasks from './components/Tasks.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Forgot from './components/Forgot.vue'
import ResetPassword from './components/ResetPassword.vue'

export default {
    mode: 'history',
    base: process.env.BASE_URL,
    fallback: true,
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/tasks',
            name: 'Tasks',
            component: Tasks
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/forgot',
            name: 'Forgot',
            component: Forgot
        },
        {
            path: '/reset-password/:token',
            name: 'ResetPassword',
            component: ResetPassword
        }
    ]
}
