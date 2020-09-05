import VueRouter from "vue-router";
import {routes} from './routes'
import Vuelidate from 'vuelidate'
import Snotify,{ SnotifyPosition} from 'vue-snotify'
require('./bootstrap');
require('@voerro/vue-tagsinput/dist/style.css')

window.Vue = require('vue');

import { store } from './store/'


const DEFAULT_TITLE="ProptBox"


import VoerroTagsInput from '@voerro/vue-tagsinput';
 
Vue.component('tags-input', VoerroTagsInput);

Vue.use(VueRouter);
Vue.use(Vuelidate)


import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading, { /* options */ });



const options={
    toast:{
        position:SnotifyPosition.rightTop
    }
}

Vue.use(Snotify,options)


Vue.filter('capFirst',function(value){
    return value.charAt(0).toUpperCase() + value.substr(1)
})


let router = new VueRouter({
    mode: 'history',
    routes
});



// ************************************************** //
//            Event Bus                               //
// **************************************************//

window.eventBus=new Vue()




router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: 'session.signin',
            })
        }
        else {
            next();
        }
    }
    else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'dashboard',
            })
        }
        else {
            next();
        }
    } else {
        next()
    }
})



router.afterEach( (to,from) => {
 //these hooks do not get a next function and cannot affect the navigation}
    Vue.nextTick(()=>{
        document.title=to.meta.title || DEFAULT_TITLE
    })
})



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-app', require('./components/App.vue').default);
Vue.component('nav-bar', require('./components/partials/NavView.vue').default);


const app = new Vue({
    router,
    store,
    el: '#app',
});