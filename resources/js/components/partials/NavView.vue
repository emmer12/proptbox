<template>
  <div>
    <div class="nav">
      <div class="container">
        <div class="nav-c nav-top" :class="{added:tReveal}">
          <div class="row">
            <div class="col-md-8 col-sm-10">
              <div class="left">
                <div class="bar" @click="openDrawer">
                  <i class="fa fa-bars"></i>
                </div>
                <div class="logo">
                  <strong>PROPTYBOX</strong>
                </div>
                <div class="search">
                  <input type="search" class="form-control" name="search" />
                  <button class="btn btn-primary ml-2">Search</button>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-2">
              <div class="right">
                <div v-show="tReveal">
                  <router-link
                    tag="button"
                    class="btn btn-primary pr-4 pl-4"
                    :to="{name:'list'}"
                  >List</router-link>
                  <router-link tag="button" class="btn btn-primary" :to="{name:'request'}">Request</router-link>
                </div>
                <div class="avatar">
                  <img src="/images/user.png" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="nav-c nav-bottom">
          <div class="row">
            <div class="col-md-6">
              <div class="left">
                <div class="culture">
                  <h1>FASTEST GROWING</h1>
                  <h1>PROPERTY HUB</h1>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="right">
                <div>
                  <router-link
                    tag="button"
                    class="btn btn-primary pr-4 pl-4"
                    :to="{name:'list'}"
                  >Lists</router-link>
                  <router-link tag="button" class="btn btn-primary" :to="{name:'request'}">Requests</router-link>
                </div>
                <div class="avatar pl-4 d-none">
                  <img src="/images/user.png" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-show="tReveal" style="margin-top:100px">Nav reveal test</div>

    <!-- Drawer View -->
      <transition enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
        <side-bar v-show="drawer"></side-bar>
      </transition>
    <!-- Close Drawer View -->
  </div>
</template>

<script>
import SideBar from "./SideBar";

export default {
  components: {
    SideBar
  },
  data() {
    return {
      tReveal: false,
      drawer: false
    };
  },
  methods: {
      openDrawer(){
    this.drawer=!this.drawer
  }
  },
  watch: {
    $route(){
      this.openDrawer()
    }
  },
  created() {
    let tis = this;
    document.addEventListener("scroll", function() {
      tis.tReveal = window.scrollY < 200 ? false : true;
    });
    window.eventBus.$on("openDrawer", this.openDrawer);
  }
};
</script>

<style lang="scss" scoped>
.nav {
  background-color: #eef4ff;
  left: 0;
  top: 0;
  z-index: 999;
  position: relative;
}
.nav-top {
  position: relative;
  height: 70px;
  border-bottom: 1px solid #ccc;
  transition: all 1s;
  &.added {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    padding: 0px 100px;
    background-color: #eef4ff;
  }
}
.nav-bottom {
  height: 100px;
  & .right {
    display: flex;
    justify-content: space-between;
    line-height: 100px !important;
  }

  & .left {
    display: block;
    line-height: 100px !important;
  }
}
.nav-c {
  & .right {
    float: right;
    line-height: 70px;
    display: flex;
    & img {
      height: 40px;
      width: 40px;
      border-radius: 20px;
    }
  }
  & .left {
    display: flex;
    align-items: center;

    & .bar {
      // padding:10px;
      // position: absolute;
      height: 40px;
      width: 40px;
      color: white;
      background: #3490dc;
      border-radius: 100%;
      text-align: center;
      font-size: 25px;
      line-height: 40px;
      margin: 0px 20px;
      // left:0p;
    }

    & .culture {
      transform: translateX(-50px);
      line-height: 100px !important;
      margin-top: 15px;
      & h1 {
        font-size: 24px;
        line-height: 20px;
        color: #444;
      }
    }
    & .logo,
    .search {
      line-height: 70px;
    }
    & .search {
      margin: 0px 0px 0px 50px;
      display: flex;
      & button {
        margin-right: 10px;
      }
    }
  }
  //   line-height: 50px;
}
</style>