<template>
   <div class="home-con">
       <div class="sidebar d-none d-sm-block d-md-block">
         <div class="header">
           <span>Request</span>
           <router-link  :to="{name:'request'}">View all</router-link>
           
         </div>
           <div class="body">
              <div class="container">
                <div v-if="!loadingReq">
                  <div v-if="hRequest.length">
                    <div class="row">
                      <div class="" v-for="(request, index) in hRequest" :key="`request-${index}`">
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
            <router-link :to="{name:'request'}">View all <i class="fa fa-arrow-down" aria-hidden="true"></i></router-link>
           </div>
       </div>

       <div class="right">
          <!-- <div class="header">
            <router-link to="#">Filter</router-link>
         </div> -->
          <div class="header d-sm-none" >
          <h4>Find a useful space in 24 hours</h4>
          <div class="s-con" id="s-con">
            <input placeholder="Search" @focus="focusSearch" v-on:blur="blurSearch" v-model="search" class="form-control" />
            <div class="btn btn-primary" @click="submitSearch"  style="height: 37px;margin-left: 5px;line-height: 37px;padding: 0px 20px;"><i class="fa fa-search" aria-hidden="true"></i></div>
          </div>
         </div>
          <div class="container d-sm-none">
                <div v-if="!loadingReq">
                  <div class="mobile-request" v-if="hRequest.length">
                      <div class="card-m" v-for="(request, index) in hRequest" :key="`request-${index}`">
                        <request-card-mobile :request="request"></request-card-mobile>
                      </div>
                      <div style="padding: 10px;align-self: center;">
                        <router-link tag="button" class="btn btn-primary" style="border-radius:50%" :to="{name:'request'}"><i class="fa fa-arrow-right" aria-hidden="true"></i></router-link>
                      </div>
                  </div>

                  <div v-else>
                    <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
                      <h4 class="alert-heading">No request available</h4>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <preloader :type="'request-mobile'"></preloader>
                </div>
           </div>
         <div class="body">
           <div class="container">

           <div  v-if="!loading" >
             <div class="row">
               <div v-if="!listing.length">
                    <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
                      <h4 class="alert-heading">No Listing available</h4>
                    </div>
               </div>
               <div  v-else class="col-md-4 col-ms-6" v-for="list in listing" :key="`listing-${list.id}`" >
                  <propt-card :list="list" :id="list.id"></propt-card>
               </div>
             </div>
           </div>
             
            <div v-else>
              <preloader :type="'list'"></preloader>
            </div>
           </div>
          <infinite-loading @infinite="infiniteHandler"></infinite-loading> 
         </div>
         <router-link to="/signup" v-if="!loggedIn">
           <span class="btn btn-primary">Register to view more</span>
         </router-link>
       </div>
   </div>
</template>

<script>

import ProptCard from '../partials/ProptCard'
import RequestCardMobile from '../partials/RequestCardMobile'
import RequestCard from '../partials/RequestCard'
import { mapActions, mapGetters } from "vuex";
import Preloader from './../partials/ContentPreloader'


export default {
  components: {
    ProptCard,
    RequestCardMobile,
    Preloader,
    RequestCard
  },
  data () {
    return {
      page:1,
      listing:[],
      loadingReq:true,
      loading:false,
      search:''
    }
  },
   methods: {
   focusSearch(){
      let el=document.getElementById('s-con').classList.add('focus')
   },
   blurSearch(){
      let el=document.getElementById('s-con').classList.remove('focus')
   },
    submitSearch(){
      if (this.$route.query.search!==`${this.search}`) {
           this.$router.push({name:'list',query:{search:this.search}})
          }  
    },
    ...mapActions(["getListing","getRequestLimit"]),
    infiniteHandler($state){
      this.loading=true && !this.listing.length;
     this.getListing({
        page:this.page
      }).then(res=>{
        this.loading=false;
         if (res.data.data.length) {
          this.page += 1;
          this.listing.push(...res.data.data);
          $state.loaded();
        } 
        else {
          $state.complete();
        }
      })
    },
 
  },

  created() {
    this.getRequestLimit().then(()=>{
      this.loadingReq=false;
    });
  },
  mounted () {
  //  this.infiniteHandler()
  },
  computed: {
    ...mapGetters(["hRequest","loggedIn"])
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
         padding: 10px;
      position: relative;
      height: 70px;
      background: #eef4ff;
      display: flex;
      flex-direction: column;
      height: 150px;
      justify-content: center;
      align-items: center;
      & .btn-outlined {
        position: absolute;
        background: transparent;
        border-color: #3490dc;
        margin: 5px;
        right: 20px;
      }
       & .s-con{
        width:70%;
        display: flex;
        transition:0.3s;
        float: right;

        &.focus{
          width:100%;
        } 
      }

      }
    }
  }

  @media (max-width:460px){
    .home-con{
      & .right{
      margin-left:0px;
    }
    }
    .mobile-request{
      display:flex;
      overflow-x:scroll;

      .card-m{
        margin:10px;
      }
      .riquest-b{
        width:300px;
        margin:10px;
      }

    }
  }
</style>