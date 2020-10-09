<template>
    <div>

         <nav-view v-show="!['session','access.signup','access.signin','setup','access.forget.password','access.reset.password','chats'].includes($route.name)"></nav-view>

              <transition name="fade" enter-active-class="animated fadeIn"  leave-active-class="animated fadeOut" mode="out-in">
                  <router-view></router-view>
              </transition>


              <!-- <vue-progress-bar></vue-progress-bar> -->

              <!-- <div class="scroll-top" ref="scroll-top" @click="scrollTop">
                  <i class="icon angle double up"></i>
              </div> -->
              <message v-if="user && !user.verified" :msg="'Your account has not been verified'"></message>
              <vue-snotify></vue-snotify>

        <edit-modal :id="id" v-if="editMode"></edit-modal> 
        <footer-nav v-show="!['chats','access.signup','access.signin','access.reset.password','setup','access.reset.password'].includes($route.name)"></footer-nav>
    </div>


</template>

<script>
 import NavView from "./partials/NavView.vue";
import EditModal from './partials/EditModal'

 import FooterNav from "./partials/FooterNav.vue";
 import Message from "./partials/Message";
import { mapGetters } from 'vuex';
    export default {
        components:{
            NavView,
            Message,
            FooterNav,
            EditModal
        },
        data(){
            return {
                users:[],
                show:true,
                id:null,
                editMode:false,
            }
        },
        mounted() {
            // this.$Progress.finish()
        },
        methods: {
            getCurrentLocation(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.setCurrentPosition);
                }else{
                    alert('geoLocation not supported');
                }
            },
            setCurrentPosition(position){
                let pos={lat:position.coords.latitude,long:position.coords.longitude}
                console.log('====================================');
                console.log(position);
                console.log('====================================');
                this.$store.dispatch('setCurrentPostion',pos)

            },
            getUser:function(){
                this.$store.dispatch('getUser');
            },
            scrollTop:function(e){
                console.log('scrolling');
              $('html,body').animate({scrollTop:0},'600','swing');
            },
               editShow(id){
                this.id=id;
                this.editMode=true
              },
              closeEdit(){
                this.editMode=false     
                }
        },
        created(){
            window.eventBus.$on('showEdit',(data)=>{
            this.editShow(data)
           })
            window.eventBus.$on('closeEdit',this.closeEdit)


            
            // this.getCurrentLocation()

            // this.$Progress.start();
            // this.$router.beforeEach((to, from, next) => {
            //     this.$Progress.start();
            //     console.log('started',this.$Progress);
                
            //     next()
            // })

            // this.$router.afterEach( route => {
            //     //these hooks do not get a next function and cannot affect the navigation}
            //     this.$Progress.finish()
            // })
            try {
                let token=localStorage.getItem('token')
                if (token) {
                    this.getUser()
                }

            } catch (error) {
                console.log(error);
                
            }
            
        },
        computed: {
            ...mapGetters([
                'user'
            ])
        },
        
    }
</script>
<style >
@import "~vue-snotify/styles/material.css";
@import "~font-awesome/css/font-awesome.css";
</style>
<style lang="scss" scoped>
   .scroll-top{
       height:50px;
       width:50px;
       right:10px;
       bottom: 60px;
       position: fixed;
       background:white;
       border-radius: 50%;
       box-shadow:2px 3px 4px #888;
       line-height: 50px;
       text-align: center;
       font-size: 16px;
       cursor:pointer;
       z-index: 999;
       
   }
</style>
