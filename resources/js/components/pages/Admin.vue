<template>
  <div class="container">
    <div class="admin-con">
      <div class="bar" @click="openSide" :class="{added:open}">
        <i class="fa fa-bars"></i>
      </div>
      <div class="side-bar" :class="{added:open}">
        <router-link
          :class="{ active: $route.name == 'admin.users' }"
          tag="li"
          :to="{ name: 'admin.users' }"
          >User</router-link
        >
        <router-link
          :class="{ active: $route.name == 'admin.listing' }"
          tag="li"
          :to="{ name: 'admin.listing' }"
          >Listings</router-link
        >
        <router-link
          :class="{ active: $route.name == 'admin.request' }"
          tag="li"
          :to="{ name: 'admin.request' }"
          >Requests</router-link
        >
        <router-link
          :class="{ active: $route.name == 'admin.boosted' }"
          tag="li"
          :to="{ name: 'admin.boosted' }"
          >Boosed Posts</router-link
        >
      </div>
      <div class="body" :class="{added:open}">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      users: [],
      open:false
    };
  },

  methods: {
    ...mapActions(["getAllUsers"]),
    openSide(){
        this.open=!this.open
    }
  },
  watch: {
    $route(){
        this.open=false
    }  
  },
  mounted() {
    this.getAllUsers().then((res) => {
      this.users = res.data.data;
    });
  },
};
</script>

<style lang="scss" scoped>
.admin-con {
  .bar {
    display: none;
    height: 30px;
    width: 30px;
    color: #3490dc;
    background: white;
    border-radius: 15px;
    text-align: center;
    font-size: 20px;
    line-height: 30px;
    margin: 0px 0px;
    cursor: pointer;
  }
  .side-bar {
    width: 270px;
    height: 100%;
    background-color: #eef4ff;
    position: fixed;

    li {
      display: block;
      padding: 10px;
      background: #fff;
      color: #444;
      cursor: pointer;
      margin: 3px;
      transition: 0.3s;
      &:hover {
        background: #3490dc;
        color: #fff;
      }

      &.active {
        background: #3490dc;
        color: #fff;
      }
    }
  }

  .body {
    margin-left: 270px;
  }
}

@media (max-width: 600px) {
  .admin-con {
    .bar {
      display: block;
    }
    .side-bar {
      left: -270px;
      transition:0.3s ease-in-out;

      &.added{
          left:0px
      }
    }
    .body {
      margin-left: 0px;
      transition:0.3s ease-in-out;

      &.added{
          margin-left:270px
      }
    }
  }
}
</style>