<template>
  <div class="container">
     <banner-view></banner-view>

    <div class="listing">
        <div class="header">
            <h4>My Listing</h4>
        </div>
       <propt-card></propt-card>
    </div>
  </div>
</template>

<script>
import BannerView from '../partials/BannerView';
import ProptCard from '../partials/ProptCard';
export default {
    components:{
        BannerView,
        ProptCard,
    }
}
</script>

<style>

</style>