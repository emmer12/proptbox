<template>
  <div class="container">
     <banner-view v-if="user" :from="'list'" :user="user"></banner-view>
      <div v-else>
              <preloader :type="'pro'"></preloader>
      </div>
    <div class="listing">
        <div class="header">
            <h4>My Listing</h4>
        </div>
       <div >
        <div v-if="user">
            <div v-if="!user.listing.length">
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
                <div  class="col-md-4 col-sm-6 col-sm-12" v-for="list in user.listing" :key="list.id" >
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
    created () {
    window.scrollTo(0,0)
      this.$store.dispatch('getUser')  
    },

    computed: {
        ...mapGetters([
            'user'
        ])
    },
}
</script>

<style>

</style>