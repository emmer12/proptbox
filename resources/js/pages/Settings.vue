<template>
  <div class="settings">
    <div class="header">
        <h4>Account settings</h4>
    </div>
     <div class="con">
         <ul>
             <router-link :to="{name:'account-set'}" tag="li">Account settings</router-link>
             <router-link :to="{name:'profile-set'}" tag="li">Profile settings</router-link>
             <router-link :to="{name:'about'}" tag="li">About us</router-link>
             <router-link :to="{name:'terms'}" tag="li">Terms and conditon</router-link>
             <router-link v-if="user.isAdmin" :to="{name:'admin'}" tag="li">Admin Dashboard</router-link>
             <router-link to="/logout" tag="li">Logout</router-link>
         </ul>
     </div>

     <router-view></router-view>
  </div>
</template>

<script>
import SettingView from "../components/Settingview";

export default {
components:{
  SettingView
},
data() {
  return {
  }
},

computed: {
  user(){
    return this.$store.getters.user
  }
}
}
</script>

<style lang="scss" scoped>
    .settings{
        .header{
            background: #eef4ff;
            padding-left: 25px;
           padding: 27px;
            & h4 {
                font-weight: 700;
            }
        }
      .con{
        max-width:600px;
        margin:auto;
        transform: translateY(-25px);
        background:white;
        padding:10px;

        ul{
            margin:0px;
            padding:0px;
            display:flex;
            flex-direction:column;
             
             li{
                list-style:none;
                padding:10px;
                font-size: 14px;
                cursor:pointer;
                 background: #eef4ff;
                 margin: 3px 0px;
                 font-weight: 500;
                 transition: 0.3s ease;
                 &:hover{
                         background: #3490dc;
                       color: white;

                 }

             }
        }
      }



    }
</style>