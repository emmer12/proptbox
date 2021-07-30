<template>
  <div class="request-con">
    <div class="left"  :class="{sticky,added:tFilter}">
      <div class="header">
        <span>Filter</span>
        <div style="position:absolute;right:10px;top:10px;color:grey;font-size:20px" class="d-sm-none" @click="tFilter=!tFilter"><i class="fa fa-times-circle-o" aria-hidden="true"></i> </div>

      </div>
      
<!-- 
      <div>
        <div class="sub-header">
          <span>Popular tag</span>
        </div>
        <button class="btn btn-outlined">Self contain</button>
        <button class="btn btn-outlined">Akure</button>
        <button class="btn btn-outlined">Clean</button>
        <button class="btn btn-outlined">Fine</button>
      </div> -->

      <div>
        <div class="sub-header">
          <span>Location</span>
        </div>
        <select @change="filterLocation" name id class="form-control" v-model="location">
          <option selected value="" disabled>Select Location</option>
          <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
        </select>
      </div>

      <div>
        <!-- <div class="sub-header">
          <span>Busget</span>
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
                  
                </div> -->
      </div>
    </div>

    <div class="right" style="margin-top:50px">
     <div class="header d-sm-none" > 
          <div class="s-con" id="">
            <input placeholder="Search" @focus="focusSearch" v-on:blur="blurSearch" v-model="search" class="form-control" />
          </div>
          <div>
             <div class="btn btn-outlined" @click="toggleFilter">Filter <i class="fa fa-caret-down" aria-hidden="true"></i> </div>
          </div>
      </div>
      <div class="container">
        <div v-if="!loading">
          <div v-if="requests.length">
            <div class="row">
              <div class="col-md-4" v-for="(request, index) in requests" :key="index">
                <requests :request="request"></requests>
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
          <preloader :type="'list'"></preloader>
        </div>
      </div>

      <infinite-loading v-if="mode==='start'" @infinite="infiniteHandler">
        <div slot="no-more"></div>
      </infinite-loading>
    </div>
  </div>
</template>

<script>
import Preloader from "./../partials/ContentPreloader";
import Requests from "./../partials/RequestCard";
import { mapActions, mapGetters } from "vuex";

export default {
  components: {
    Preloader,
    Requests
  },
  data() {
    return {
      requests: [],
      loading: false,
      mode:'start',
      page: 1,
      search:"",
      location:'',
       budget:{
        max_budget:'',
        min_budget:''
      },
      tFilter:false,
      sticky:false
    };
  },
  methods: {
    ...mapActions(["getRequest",'getState',"selectRLocation",'filterReqRange','Request','searchRequest']),

    infiniteHandler($state) {
     this.loading=true && !this.requests.length;
     this.getRequest({
        page:this.page
      }).then(res=>{
        this.loading=false;
         if (res.data.data.length) {
          this.page += 1;
          this.requests.push(...res.data.data);
          $state.loaded();
        } 
        else {
          $state.complete();
        }
      })
    },
     submitSearch(){
      if (this.$route.query.search!==`${this.search}`) {
           this.$router.push({name:'request',query:{search:this.search}})
          }  
    },
   
     filterLocation(){
    this.mode='location'
    this.loading=true
    this.selectRLocation({
        location: this.location
      }).then((res)=>{
        this.loading=false
        this.requests=res.data.data;     
      })
   },
   filterR(){
    this.mode='range'
    this.loading=true
    this.filterReqRange(
        this.budget
      ).then((res)=>{
        this.loading=false
        this.requests=res.data.data;
      })
   },
   searchR(){
    this.mode='search'
    this.loading=true
    this.searchRequest({
        s:this.$route.query.search || this.search
      }).then((res)=>{
        this.loading=false
        this.requests=res.data.data;
      })
   },
    focusSearch(){
      let el=document.getElementById('s-con').classList.add('focus')
   },
   blurSearch(){
      this.searchR()
   },
    toggleFilter(){
     this.tFilter=!this.tFilter
   }
  },
  watch: {
     $route() {
      this.searchR()
    }
  },

  created () {
     let tis = this;
    document.addEventListener("scroll", function() {
      tis.sticky = window.scrollY < 300 ? false : true;
    });
    if (this.$route.query.search) {
      this.searchR()
    }

     this.getState();
    },
  
  computed: {
    ...mapGetters([
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
    background: #fff;
    height: 100%;
    top: 50px;
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
      background: #eef4ff;
      // display: flex;
      // flex-direction: column;
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
        display: flex;
        transition:0.3s;
        float: right;
        width:70%;

        &.focus{
          width:100%;
        } 
      }
    }
  }
}
 @media (max-width:460px){
    .request-con .right{
      margin-left:0px;
      
      & .header{
         display:flex;
       flex-direction:row;
       justify-content: space-between;


        & .btn-outlined {
        position: relative;
    }
      }
    }
    .request-con {
      .left {
      transition:0.3s;
      position: absolute;
      z-index:9999;
      left:-270px;
      background:white;


      &.added{
        left:0px
      }

    }
   }
  }
</style>