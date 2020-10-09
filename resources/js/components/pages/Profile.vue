<template>
  <div class="container" v-if="!notFound">
     <banner-view v-if="profile" :from="'list'" :user="profile"></banner-view>
      <div v-else>
         <preloader :type="'pro'"></preloader>
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
import BannerView from '../partials/BannerView';
import ProptCard from '../partials/ProptCard';
import Preloader from './../partials/ContentPreloader'
export default {
    components:{
        BannerView,
        ProptCard,
        Preloader
    },
    data() {
        return {
            notFound:''
        }
    },
    created () {
      window.scrollTo(0,0)
      this.$store.dispatch('getUserById',{id:this.$route.params.id}).catch((res)=>{
          this.notFound=res.response.data.message          
      })  
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