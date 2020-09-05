<template>
  <div class="request-con">
    <div class="left">
      <div class="header">
        <span>Filter</span>
      </div>

      <div>
        <div class="sub-header">
          <span>Popular tag</span>
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
          <span>Busget</span>
        </div>

        <input type="range" />
      </div>
    </div>

    <div class="right">
      <div class="header">
        <button class="btn btn-outlined">Search</button>
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
      location:''

    };
  },
  methods: {
    ...mapActions(["getListing",'getTags','getState','selectTag','selectLocation']),
    infiniteHandler($state) {
      this.getListing({
        page: this.page
      }).then(({ data }) => {
        this.loading = false;
        if (this.page < data.meta.total) {
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
  filterTag(tag){
    this.mode='tag'
    this.selectTag({
        tag: tag
      }).then((res)=>{
        this.listing=res.data.data;
      })
   },
    filterLocation(){
    this.mode='location'
    this.selectLocation({
        location: this.location
      }).then((res)=>{
        this.listing=res.data.data;     
      })
   },
  },
  
  created () {
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

<style lang="scss">
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
    }
  }
}
</style>