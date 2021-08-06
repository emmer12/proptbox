import VueRouter from "vue-router";
import {routes} from './routes'
import Vuelidate from 'vuelidate'
import Snotify,{ SnotifyPosition} from 'vue-snotify'
import Vue from 'vue'
import VueAgile from 'vue-agile'
import moment from 'moment'
import VueTelInput from 'vue-tel-input'
 
require('./bootstrap');
require('@voerro/vue-tagsinput/dist/style.css')

window.Vue = require('vue');

import { store } from './store/'


const DEFAULT_TITLE="ProptyBox"


import VoerroTagsInput from '@voerro/vue-tagsinput';

Vue.component('tags-input', VoerroTagsInput);

Vue.use(VueRouter);
Vue.use(Vuelidate)
Vue.use(VueAgile)
Vue.use(VueTelInput) 


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

Vue.filter("timeAgo",function(value){
    if(value){
        return moment(String(value)).fromNow('dd')
    }
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
                name: 'access.signin',
            })
        }
        else {
            if (to.matched.some(record =>record.meta.requiresAdmin)) {
                console.log('====================================');
                console.log(store.getters.user.isAdmin);
                console.log('====================================');
                if (!store.getters.user.isAdmin) {
                    next({
                        name: 'home',
                    })
                }else{
                    next()
                }
            }else{
                next();
            }
        }
    }
    else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'home',
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

Vue.component('main-app', require('./App.vue').default);
Vue.component('nav-bar', require('./components/NavView.vue').default);


const app = new Vue({
    router,
    store,
    el: '#app',
});