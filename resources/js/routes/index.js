
import HomePage from '../pages/HomePage.vue';
import Page404 from '../pages/Page404';
import SignUp from '../pages/SignUp';
import SignIn from '../pages/SignIn';
import Setup from '../pages/Setup';
import SetupSignUp from '../pages/SetupSignUp';
import ForgetPassword from '../pages/ForgetPassword';
import ResetPassword from '../pages/ResetPassword';
import Session from '../pages/Session';
import SocialLoging from '../pages/SocialLoging';
import Profile from '../pages/Profile';
import List from '../pages/List';
import Request from '../pages/Request';
import Logout from '../pages/Logout';
import NewList from '../pages/NewList';
import ListEdit from '../pages/ListEdit';
import NewRequest from '../pages/NewRequest';
import ListDetails from '../pages/ListDetails';
import RequestDetails from '../pages/RequestDetails';
import Dashboard from '../pages/Dashboard';
import MyListing from '../pages/MyListing';
import MyRequest from '../pages/MyRequest';
import EmailVerify from '../pages/EmailVerify';
import VerifyEmail from '../pages/VerifyEmail';
import IdVerification from '../pages/IdRequest';
import Boost from '../pages/Boost';
import OtherPage from '../pages/OtherPage';
import ChatPage from '../pages/ChatPage';
import AboutPage from '../pages/AboutPage';
import ContactPage from '../pages/ContactPage';
import TermsPage from '../pages/TermsPage';
import AccountSettings from '../pages/AccountSettings';
import ProfileSettings from '../pages/ProfileSettings';
import Settings from '../pages/Settings';
import Admin from '../pages/Admin';
import AdminRequests from '../pages/AdminRequests';
import AdminListings from '../pages/AdminListings';
import AdminBoosted from '../pages/AdminBoosted';
import AdminUsers from '../pages/AdminUsers';

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
        path:'/settings',
        name:'settings',
        component:Settings,
        meta: {
            requiresAuth:true
         }
    },
    {
        path:'/admin/dashboard',
        name:'admin',
        component:Admin,
        meta: {
            requiresAuth:true,
            requiresAdmin:true
         },
         children:[
            {
                path: '',
                name: 'admin.users',
                component:AdminUsers,
                meta: {
                    requiresAuth:true,
                    requiresAdmin:true
                 }
            },
            {
                path: '/admin/listings',
                name: 'admin.listing',
                component:AdminListings,
                meta: {
                    requiresAuth:true,
                    requiresAdmin:true
                 }
            },
            {
                path: '/admin/requests',
                name: 'admin.request',
                component:AdminRequests,
                meta: {
                    requiresAuth:true,
                    requiresAdmin:true
                 }
            },
            {
                path: '/admin/boosted',
                name: 'admin.boosted',
                component:AdminBoosted,
                meta: {
                    requiresAuth:true,
                    requiresAdmin:true
                 }
            },
         ]
    },
    {
        path: '/settings/account',
        name: 'account-set',
        component: AccountSettings,
        meta: {
            requiresAuth:true
         }
    },
    {
        path: '/settings/profile',
        name: 'profile-set',
        component: ProfileSettings,
        meta: {
            requiresAuth:true
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
        path: '/listings',
        name: 'list',
        component: List
    },
    {
        path: '/listings/edit/:id/:creating?',
        name: 'list-edit',
        component: ListEdit
    },
    {
        path: '/profile/:id',
        name: 'profile',
        component: Profile,
    },


    {
        path: '/listing/create',
        name: 'new-list',
        component: NewList,
        meta: {
            requiresAuth:true
         }
    },

    
    {
        path: '/chats',
        name: 'chats',
        component: ChatPage,
        meta: {
            requiresAuth:true
         }
    },

    {
        path: '/listing/:id',
        name: 'list-details',
        component: ListDetails,
    },
    {
        path: '/request/:id',
        name: 'request-details',
        component: RequestDetails,
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
        path: '/id-verification',
        name: 'id.verification',
        component: IdVerification,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/boost/:id',
        name: 'boost',
        component: Boost,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/email-verify',
        name: 'email.verify',
        component:VerifyEmail,
    },
    {
        path: '/verify-email',
        name: 'verify-email',
        component:EmailVerify,
    },
    {
        path: '/explore',
        name: 'explore',
        component: OtherPage,
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
        path: '/about/:mobile?',
        name: 'about',
        component: AboutPage,
    },
     {
        path: '/contact/:mobile?',
        name: 'contact',
        component: ContactPage,
    },
    {
        path: '/terms/:mobile?',
        name: 'terms',
        component: TermsPage,
    },
    {
        path: '*',
        name: '404',
        component: Page404,
    },
];
