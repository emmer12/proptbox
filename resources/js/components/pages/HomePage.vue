<template>
   <div class="home-con">
       <div class="sidebar">
         <div class="header">
           <span>Request</span>
           <router-link to="#">View all</router-link>
           
         </div>
           <div class="body">
              <div class="container">
                <div v-if="!loadingReq">
                  <div v-if="hRequest.length">
                    <div class="row">
                      <div class="" v-for="(request, index) in hRequest" :key="index">
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

           <div class="footer">
            <router-link :to="{name:'request'}">View all <i class="fa fa-arrow-right" aria-hidden="true"></i></router-link>
           </div>
       </div>

       <div class="right">
          <div class="header">
            <router-link to="#">Filter</router-link>
         </div>

         <div class="body">
           <div  v-if="listing.length" >
              <propt-card :lists="listing"></propt-card>
           </div>
             
           <div v-else>
              <preloader :type="'list'"></preloader>
            </div>
          <infinite-loading @infinite="infiniteHandler"></infinite-loading> 
         </div>
       </div>
   </div>
</template>

<script>

import ProptCard from '../partials/ProptCard'
import RequestCard from '../partials/RequestCard'
import { mapActions, mapGetters } from "vuex";
import Preloader from './../partials/ContentPreloader'

export default {
  components: {
    ProptCard,
    RequestCard,
    Preloader
  },
  data () {
    return {
      page:1,
      listing:[],
      loadingReq:true,
    }
  },
   methods: {
    ...mapActions(["getListing","getRequestLimit"]),

    infiniteHandler($state){
      this.getListing({
        page:this.page
      }).then(({data})=>{
         if (this.page<data.meta.total) {
          this.page += 1;
          data.data.forEach(list=>{
            if (!this.listing.includes(list)) {
              this.listing.push(list)
            }
          })
          $state.loaded();
        } else {
          alert()
          $state.complete();
        }
      })
    },
    
    
  },

  created() {
    // this.infiniteHandler();
    this.getRequestLimit().then(()=>{
      this.loadingReq=false;
    });
  },
  computed: {
    ...mapGetters(["hRequest"])
  }
}
</script>

<style lang="scss" scoped>
  .home-con{
    overflow: hidden;
    & .sidebar{
      // padding-bottom:200px;
      &.added{
        top:70px;
      }
      position: absolute;
      width:300px;
      height:100%;
      overflow-y: scroll;
      padding:10px;

      &::-webkit-scrollbar{
        background:#eef4ff;
        width:5px;
      }

      &::-webkit-scrollbar-thumb{
        background:#3490dc;
        border-radius:2.5px
      }
      
      & .header{
        height:50px;
        line-height:50px; 
        display: flex;
        justify-content:space-between;
        padding:0px 10px;   
        font-weight: 700;  
      }

      & .footer{
        background:#eef4ff;
        color:white;
        width:100%;
        position: relative;
        bottom:0px;
        padding: 10px;
        text-align:center
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