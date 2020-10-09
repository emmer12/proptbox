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
       <div v-if="user">
              <div v-if="user.request.length">
                <div class="row">
                  <div class="" v-for="(request, index) in user.request" :key="index">
                    <request-card :request="request"></request-card>
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
                  <h4 class="alert-heading">No request available</h4>
                </div>
              </div>
            </div>
            <div v-else>
              <preloader :type="'request'"></preloader>
            </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import BannerView from "../partials/BannerView";
import Preloader from "./../partials/ContentPreloader";
import ProptCard from "../partials/ProptCard";
import RequestCard from "../partials/RequestCard";
export default {
  components: {
    BannerView,
    ProptCard,
    Preloader,
    RequestCard
  },

  computed: {
    ...mapGetters(["user"])
  }
};
</script>

<style>
</style>