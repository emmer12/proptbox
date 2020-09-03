<template>
  <div>
    <!-- <div class="banner"></div> -->
    <div class="container">
      <banner-view v-if="user" :from="'request'"></banner-view>
      <div v-else>
        <preloader :type="'pro'"></preloader>
      </div>

      <div class="listing">
        <div class="header">
          <h4>My Request</h4>
        </div>
        <propt-card></propt-card>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import BannerView from "../partials/BannerView";
import Preloader from "./../partials/ContentPreloader";
import ProptCard from "../partials/ProptCard";
export default {
  components: {
    BannerView,
    ProptCard,
    Preloader
  },

  computed: {
    ...mapGetters(["user"])
  }
};
</script>

<style>
</style>