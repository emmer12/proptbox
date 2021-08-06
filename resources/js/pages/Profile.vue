<template>
  <div class="container" v-if="!notFound">
    <div v-if="loading">
         <preloader :type="'pro'"></preloader>
    </div>
      <div v-else>
           <banner-view  :user="profile"></banner-view>
      </div>
    <div class="listing">
        <div class="header">
            <h4>Listings</h4>
        </div>
       <div >
        <div v-if="profile">
            <div v-if="!profile.listing.length">
                <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
                <h4 class="alert-heading">Empty Listings</h4>
                <router-link
                    :to="{name:'new-list'}"
                    tag="button"
                    class="btn btn-primary"
                >
                   Create List
                 <i class="fa fa-plus" aria-hidden="true"></i>
                </router-link>
             </div>
            </div>
            <div v-else class="row">
                <div  class="col-md-4 col-sm-6 col-sm-12" v-for="list in profile.listing" :key="list.id" >
                <propt-card :list="list" :id="list.id" ></propt-card>
            </div>
            </div>
           </div>
           <div v-else>
              <preloader :type="'list'"></preloader>
           </div>
       </div>
    </div>
  </div>
  <div v-else class="container">
      <div class="alert alert-info" role="alert">
          <strong><i class="fa fa-wind-warning    "></i> Page not found</strong>
      </div>
      <router-link to="/" tag="button" class="btn btn-primary"> Go back home</router-link>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import BannerView from './../components/BannerView';
import ProptCard from './../components/ProptCard';
import Preloader from '././../components/ContentPreloader'
export default {
    components:{
        BannerView,
        ProptCard,
        Preloader
    },
    data() {
        return {
            notFound:false,
            loading:false
        }
    },
    methods: {
        getProfile(){
            this.loading=true;
              this.$store.dispatch('getUserById',{id:this.$route.params.id}).then(()=>{
               this.loading=false   

              }).catch((res)=>{
               this.loading=false   
               this.notFound=res.response.data.message          
              })  
        }
    },
    created () {
      window.scrollTo(0,0)
      this.getProfile()
    },

    computed: {
        ...mapGetters([
            'profile'
        ])
    },
}
</script>

<style>

</style>