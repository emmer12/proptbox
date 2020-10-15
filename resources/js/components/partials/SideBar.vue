<template>
  <div class="sidebar">
      <span @click="closeDrawer">
          <i class="fa fa-times" aria-hidden="true"></i>
      </span>
      <div class="header">
          <img src="/images/logo.svg" />
      </div>

      <div class="">
          <ul>
              <router-link :class="{active:$route.name=='dashboard'}" tag="li" :to="{name:'dashboard'}">Profile</router-link>
              <router-link :class="{active:$route.name=='list'}" tag="li" :to="{name:'list'}">Listings</router-link>
              <router-link :class="{active:$route.name=='request'}" tag="li" :to="{name:'request'}">Requests</router-link>
              <!-- <router-link :class="{active:$route.name=='support'}" tag="li" to="/">Support </router-link> -->
          </ul>
      </div>

  </div>
</template>

<script>
export default {
    methods: {
        closeDrawer(){
            window.eventBus.$emit('openDrawer');
        }
    }
};
</script>

<style lang="scss" scoped>
.sidebar{
    background:#0d50bd;
    height:100vh;
    width:270px;
    position:fixed;
    top:0;
    left:0;
    z-index:999;
    color:white;
    padding:50px 0px;
    padding-left: 30px;

    & span{
        position:absolute;
        cursor:pointer;
        top:20px;
        right:30px;
        & i{
            font-size:25px;
        }
    }

    & ul {
        padding:0px;
        margin:0px;
        margin-top:50px;
        & li{
            list-style:none;
            display:block;
            color:white;
            padding:10px;
            background:rgba($color:#0c46a3, $alpha: 0.8);
            margin:5px 0px;
            cursor:pointer;

           &.active{
               border-left:5px solid white;
           }
        }
    }
}

</style>