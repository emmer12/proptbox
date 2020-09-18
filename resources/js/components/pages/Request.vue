<template>
  <div class="request-con">
    <div class="left  d-none d-sm-block d-md-block"  :class="{sticky}">
      <div class="header">
        <span>Filter</span>
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
          <option selected value disabled>Select Location</option>
          <option value="Lagos">Lagos</option>
          <option value="Ondo">Ondo</option>
          <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
        </select>
      </div>

      <div>
        <div class="sub-header">
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
                  
                </div>
      </div>
    </div>

    <div class="right">
      <div class="header">
         <div class="s-con" id="s-con">
            <input placeholder="Search"  @focus="focusSearch"  v-on:blur="blurSearch" v-model="search" class="form-control" />
            <div class="btn btn-primary" @click="submitSearch" style="height:40px;margin-left:5px"><i class="fa fa-search" aria-hidden="true"></i></div>
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

      <infinite-loading v-if="mode==='start'" @infinite="infiniteHandler"></infinite-loading>
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
      loading: true,
      mode:'start',
      page: 1,
      search:"",
      location:'',
       budget:{
        max_budget:'',
        min_budget:''
      },
      sticky:false
    };
  },
  methods: {
    ...mapActions(["getRequest","selectRLocation",'filterReqRange','Request','searchRequest']),

    infiniteHandler($state) {
      this.getRequest({
        page: this.page
      }).then(({ data }) => {
        this.loading = false;
        if (this.page < data.meta.total || this.page===1) {
          this.page += 1;
          data.data.forEach(request => {
            if (!this.requests.includes(request)) {
              this.requests.push(request);
            }
          });
          $state.loaded();
        } else {
          alert()
          $state.complete();
        }
      });
    },
     submitSearch(){
      if (this.$route.query.search!==`${this.search}`) {
           this.$router.push({name:'request',query:{search:this.search}})
          }  
    },
   created () {
     this.infiniteHandler()
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
      let el=document.getElementById('s-con').classList.remove('focus')
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
    }else{
      this.infiniteHandler()
    }
    // this.getState();
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
    }
  }
</style>