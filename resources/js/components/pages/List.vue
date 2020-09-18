<template>
  <div class="request-con">
    <div class="left d-none d-sm-block d-md-block" :class="{sticky}" >
      <div class="header">
        <span>Filter</span>
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
          <option value="Lagos">Lagos</option>
          <option value="Ondo">Ondo</option>
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
      <div class="header">
          <div class="s-con" id="s-con">
            <input placeholder="Search" @focus="focusSearch" v-on:blur="blurSearch" v-model="search" class="form-control" />
            <div class="btn btn-primary" @click="submitSearch"  style="height:40px;margin-left:5px"><i class="fa fa-search" aria-hidden="true"></i></div>
          </div>
      </div>
      <div class="container">
         <div  v-if="listing && !loading" >
              <propt-card :lists="listing"></propt-card>
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
      loading: true,
      page: 1,
      mode:'start',
      location:'',
      search:'',
      budget:{
        max_budget:'',
        min_budget:''
      },
      sticky:false

    };
  },
  methods: {
    ...mapActions(["getListing",'getTags','getState','selectTag','selectLocation','searchListing','filterRange']),
    infiniteHandler($state) {
      this.getListing({
        page: this.page
      }).then(({ data }) => {
        this.loading = false;
        if (this.page <= data.meta.total) {
          this.page += 1;
          data.data.forEach(list => {
            if (!this.listing.includes(list)) {
              this.listing.push(list);
            }
          });
          $state.loaded();
        } else {
          $state.complete();
        }
      });
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
   }
  },
  watch: {
     $route() {
      this.searchL()
    }
  },
  
  created () {
    let tis = this;
    document.addEventListener("scroll", function() {
      tis.sticky = window.scrollY < 300 ? false : true;
    });
    if (this.$route.query.search) {
      this.searchL()
    }else{
      this.infiniteHandler()
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
    .request-con .right{
      margin-left:0px;
    }
  }
</style>