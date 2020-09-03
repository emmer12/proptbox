<template>
   <div class="home-con">
       <div class="sidebar">
         <div class="header">
           <span>Request</span>
           <router-link to="#">View all</router-link>
         </div>
           <div class="body">
           <request-card></request-card>
           </div>
       </div>

       <div class="right">
          <div class="header">
            <router-link to="#">Filter</router-link>
         </div>

         <div class="body">
           <propt-card :lists="listing"></propt-card>
         </div>
       </div>
   </div>
</template>

<script>

import ProptCard from '../partials/ProptCard'
import RequestCard from '../partials/RequestCard'
import { mapActions, mapGetters } from "vuex";

export default {
  components: {
    ProptCard,
    RequestCard
  },
   methods: {
    ...mapActions(["getListing","getRequest"])
  },

  created() {
    this.getListing();
  },
  computed: {
    ...mapGetters(["listing"])
  }
}
</script>

<style lang="scss" scoped>
  .home-con{
    overflow: hidden;
    & .sidebar{
      position: absolute;
      width:300px;
      height:100%;
      overflow-y: scroll;
      padding:10px;
      
      & .header{
        height:50px;
        line-height:50px; 
        display: flex;
        justify-content:space-between;
        padding:0px 10px;   
        font-weight: 700;  
      }
    }

    & .right{
      margin-left:300px;
      padding:10px;

       & .header{
        height:50px;
        line-height:50px; 
        display: flex;
        justify-content:flex-end;
        padding:0px 10px; 
        margin-right:50px;
        font-weight: 700;  
        border-bottom:1px solid #dfdfdf;
        margin-bottom:20px;

      }
    }
  }
</style>