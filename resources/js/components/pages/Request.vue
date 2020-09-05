<template>
  <div class="request-con">
    <div class="left">
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

        <input type="range" />
      </div>
    </div>

    <div class="right">
      <div class="header">
        <button class="btn btn-outlined">Search</button>
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
      location:''
    };
  },
  methods: {
    ...mapActions(["getRequest","selectLocation"]),

    infiniteHandler($state) {
      this.getRequest({
        page: this.page
      }).then(({ data }) => {
        this.loading = false;
        if (this.page < data.meta.total) {
          this.page += 1;
          data.data.forEach(list => {
            if (!this.requests.includes(list)) {
              this.requests.push(list);
            }
          });
          $state.loaded();
        } else {
          $state.complete();
        }
      });
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
  computed: {
    ...mapGetters([
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