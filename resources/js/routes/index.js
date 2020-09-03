
import HomePage from '../components/pages/HomePage.vue';
import Page404 from '../components/pages/Page404';
import SignUp from '../components/pages/SignUp';
import SignIn from '../components/pages/SignIn';
import Setup from '../components/pages/Setup';
import SetupSignUp from '../components/pages/SetupSignUp';
import ForgetPassword from '../components/pages/ForgetPassword';
import ResetPassword from '../components/pages/ResetPassword';
import Session from '../components/pages/Session';
import SocialLoging from '../components/pages/SocialLoging';
import Profile from '../components/pages/Profile';
import List from '../components/pages/List';
import Request from '../components/pages/Request';
import Logout from '../components/pages/Logout';
import NewList from '../components/pages/NewList';
import NewRequest from '../components/pages/NewRequest';
import ListDetails from '../components/pages/ListDetails';
import Dashboard from '../components/pages/Dashboard';
import MyListing from '../components/pages/MyListing';
import MyRequest from '../components/pages/MyRequest';
import EmailVerify from '../components/pages/EmailVerify';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },

   {
    path: '/session',
    name: 'session',
    component:Session,   
       children:[
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
            path: '/forget-password',
            name: 'access.forget.password',
            component: ForgetPassword,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/reset-password',
            name: 'access.reset.password',
            component: ResetPassword,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/sign-in/:provider/redirect',
            name: 'loginGithub',
            component: SocialLoging,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/sign-in/complete-setup',
            name: 'setup',
            component:Setup,
            meta: {
               requiresAuth:true
            }
        },
        {
            path: '/sign-up/complete-setup',
            name: 'complete.setup',
            component:SetupSignUp,
            // meta: {
            //     requiresVisitor: true,
            // }
        }
       ]
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
        path: '/request/create',
        name: 'new-request',
        component: NewRequest,
        meta: {
            requiresAuth:true
         }
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
        meta: {
            requiresAuth:true
         }
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
        path: '/dashboard/my-listing',
        name: 'my.listing',
        component: MyListing,
        meta: {
            requiresAuth: true,
        }
    },

    {
        path: '/dashboard/my-request',
        name: 'my.request',
        component: MyRequest,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/verify-email',
        name: 'verify-email',
        component:EmailVerify,
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
