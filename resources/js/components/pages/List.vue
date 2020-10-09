<template>
  <div class="request-con">
    <div class="left" :class="{sticky,added:tFilter}" >
      <div class="header">
        <span>Filter</span>
        <div style="position:absolute;right:10px;top:10px;color:grey;font-size:20px" class="d-sm-none" @click="tFilter=!tFilter"><i class="fa fa-times-circle-o" aria-hidden="true"></i> </div>
      </div>
         <div class="sub-header">
            <button class="btn btn-outlined" @click="getAll">All</button>
        </div>
      <div>
        <div class="sub-header">
          <span>Popular tags</span>
        </div>
        <button v-for="(tag, index) in lTags" :key="index" class="btn btn-outlined" @click="filterTag(tag.name)">{{ tag.name}}</button>
      </div>

      <div>
        <div class="sub-header">
          <span>Location</span>
        </div>
        <select @change="filterLocation" name id class="form-control" v-model="location">
          <option selected value disabled>Select Location</option>
          <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
        </select>
      </div>

      <div>
        <div class="sub-header">
          <span>Budget</span>
        </div>
               <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for>Min budget</label>
                      <input
                        type="number"
                        placeholder="Min"
                        class="form-control"
                        v-model="budget.min_budget"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for>Max budget</label>
                      <input
                        type="number"
                        placeholder="Max"
                        class="form-control"
                        v-model="budget.max_budget"
                        v-on:blur="filterR"
                      />
                    </div>
                  </div>
                  
                </div>
      </div>
    </div>

    <div class="right">
       <div class="header d-sm-none" > 
          <div class="s-con" id="">
            <input placeholder="Search" @focus="focusSearch" v-on:blur="blurSearch" v-model="search" class="form-control" />
          </div>
          <div>
             <div class="btn btn-outlined" @click="toggleFilter">Filter <i class="fa fa-caret-down" aria-hidden="true"></i> </div>
          </div>
      </div> 
       <div class="container">

           <div  v-if="!loading" >
             <div class="row">
               <div v-if="!listing.length">
                    <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
                      <h4 class="alert-heading">No Listing available</h4>
                    </div>
               </div>
               <div  v-else class="col-md-4 col-sm-6 col-sm-12" v-for="list in listing" :key="list.id" >
                  <propt-card :list="list" :id="list.id" ></propt-card>
               </div>
             </div>
           </div>
             
            <div v-else>
              <preloader :type="'list'"></preloader>
            </div>
        </div>
      <infinite-loading v-if="mode==='start'" @infinite="infiniteHandler"></infinite-loading>
    </div>
  </div>
</template>

<script>
import Preloader from "./../partials/ContentPreloader";
import ProptCard from "./../partials/ProptCard";
import { mapActions, mapGetters } from "vuex";

export default {
  components: {
    Preloader,
    ProptCard
  },
  data() {
    return {
      listing: [],
      loading: false,
      page: 1,
      mode:'start',
      location:'',
      search:'',
      budget:{
        max_budget:'',
        min_budget:''
      },
      sticky:false,
      tFilter:false,

    };
  },
  methods: {
    ...mapActions(["getListing",'getTags','getState','selectTag','selectLocation','searchListing','filterRange']),
    // infiniteHandler($state) {
    //   this.getListing({
    //     page: this.page
    //   }).then(({ data }) => {
    //     this.loading = false;
    //     if (this.page <= data.meta.total) {
    //       this.page += 1;
    //       data.data.forEach(list => {
    //         if (!this.listing.includes(list)) {
    //           this.listing.push(list);
    //         }
    //       });
    //       $state.loaded();
    //     } else {
    //       $state.complete();
    //     }
    //   });
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
    submitSearch(){
      if (this.$route.query.search!==`${this.search}`) {
           this.$router.push({name:'list',query:{search:this.search}})
          }  
    },
  filterTag(tag){
    this.mode='tag'
    this.loading=true
    this.selectTag({
        tag: tag
      }).then((res)=>{
        this.loading=false
        this.listing=res.data.data;
      })
   },
   filterR(){
    this.mode='range'
    this.loading=true
    this.filterRange(
        this.budget
      ).then((res)=>{
        this.loading=false
        this.listing=res.data.data;
      })
   },
    filterLocation(){
    this.mode='location'
    this.loading=true
    this.selectLocation({
        location: this.location
      }).then((res)=>{
        this.loading=false
        this.listing=res.data.data;     
      })
   },

    searchL(){
    this.mode='search'
    this.loading=true
    this.searchListing({
        s:this.$route.query.search || this.search
      }).then((res)=>{
        this.loading=false
        this.listing=res.data.data;    
     
      })
   },
   getAll(){
     this.$router.push({name:'list'})
   },
   focusSearch(){
      let el=document.getElementById('s-con').classList.add('focus')
   },
   blurSearch(){
      let el=document.getElementById('s-con').classList.remove('focus')
   },
   toggleFilter(){
     this.tFilter=!this.tFilter
   }
  },
  watch: {
     $route() {
      this.searchL()
    }
  },
  mounted() {
    // this.infiniteHandler()
  },
  
  created () {
    let tis = this;
    document.addEventListener("scroll", function() {
      tis.sticky = window.scrollY < 300 ? false : true;
    });
    if (this.$route.query.search) {
      this.searchL()
    }
    this.getTags();
    this.getState();
    },
  computed: {
    ...mapGetters([
      "lTags",
      "states"
    ])
    
  }
};
</script>

<style lang="scss" scoped>
.request-con {
  & .left {
    width: 270px;
    position: absolute;
    padding: 10px;
    border-right:1px solid #ccc;
    transition: 0.3s;

    &.sticky{
      position:fixed;
      top:100px
    }
    & .header {
      padding: 10px;
      font-size: 16px;
      color: #3490dc;
      font-weight: 700;

     
    }
    & .btn-outlined {
      background: transparent;
      border-color: #3490dc;
      margin: 5px;
    }
    & .sub-header {
      padding: 10px;
      font-size: 14px;
      font-weight: 700;
    }
  }
  & .right {
    margin-left: 270px;

    & .header {
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
          width:300px;
        } 
      }
    }
  }
}
 @media (max-width:460px){
  .left {
    position: absolute;
    z-index:9999;
    left:-270px;
    background:white;


    &.added{
      left:0px
    }
   }
    .request-con .right{
      margin-left:0px;

      & .header {
       display:flex;
       flex-direction:row;
       justify-content: space-between;
      

       select{
         width:100px;
         margin: 0px 20px 0px 3px;
       }

        &::-webkit-scrollbar{
        background:#eef4ff;
        width:0px;
        height:5px
      }

      &::-webkit-scrollbar-thumb{
        background:#3490dc;
        border-radius:2.5px
      }
      & .btn-outlined {
        position: relative;
        background: transparent;
        border-color: #3490dc;
        margin: 5px;
        right: 20px;
    }
  }
    }
  }
</style>