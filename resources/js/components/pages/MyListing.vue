<template>
  <div class="container">
     <banner-view v-if="user" :from="'list'"></banner-view>
      <div v-else>
              <preloader :type="'pro'"></preloader>
      </div>
    <div class="listing">
        <div class="header">
            <h4>My Listing</h4>
        </div>
       <div class="row">
           <propt-card v-if="user" :lists="user.listing"></propt-card>
           <div v-else>
              <preloader :type="'list'"></preloader>
           </div>
       </div>
    </div>
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

    computed: {
        ...mapGetters([
            'user'
        ])
    },
}
</script>

<style>

</style>