<template>
  <div>
    <div v-if="listing.length">
     <div class="container">
        <div class="row" style="margin-top:10px">
        <propt-card :lists="listing"></propt-card>
      </div>
     </div>
    </div>
    <div v-else>
      <preloader :type="'list'"></preloader>
    </div>
  </div>
</template>

<script>
import Preloader from "./../partials/ContentPreloader";
import ProptCard from '../partials/ProptCard';
import { mapActions, mapGetters } from "vuex";
export default {
  components: {
    Preloader,
    ProptCard
  },
  methods: {
    ...mapActions(["getListing"])
  },

  created() {
    this.getListing();
  },
  computed: {
    ...mapGetters(["listing"])
  }
};
</script>

<style>
</style>