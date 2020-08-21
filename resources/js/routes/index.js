
import HomePage from '../components/pages/HomePage.vue';
import Page404 from '../components/pages/Page404';
import SignUp from '../components/pages/SignUp';
import SignIn from '../components/pages/SignIn';
import ForgetPassword from '../components/pages/ForgetPassword';
import Session from '../components/pages/Session';
import Profile from '../components/pages/Profile';
import List from '../components/pages/List';
import Request from '../components/pages/Request';
import Logout from '../components/pages/Logout';
import NewList from '../components/pages/NewList';
import ListDetails from '../components/pages/ListDetails';
import Dashboard from '../components/pages/Dashboard';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },

    {
        path: '/signup',
        name: 'access.signup',
        component: SignUp,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/signin',
        name: 'access.signin',
        component: SignIn,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: 'forget-password',
        name: 'access.forget.password',
        component: ForgetPassword,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/requests',
        name: 'request',
        component: Request
    },
    {
        path: '/list',
        name: 'list',
        component: List
    },

    {
        path: '/profile/:username',
        name: 'profile',
        component: Profile,
    },


    {
        path: '/list/create',
        name: 'new-list',
        component: NewList,
    },


    {
        path: '/list/:slug',
        name: 'list-details',
        component: ListDetails,
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        }
    },


    {
        path: '/logout',
        name: 'logout',
        component: Logout,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '*',
        name: '404',
        component: Page404,
    },
];
