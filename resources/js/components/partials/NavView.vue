<template>
  <div>
    <div class="nav">
      <div class="container">
        <div class="nav-c nav-top" :class="{added:tReveal}">
          <div class="row">
            <div class="col-md-8 col-sm-10">
              <div class="left">
                <div class="bar">
                  <i class="fa fa-bars"></i>
                </div>
                <div class="logo">
                  <img src="/images/logo.svg" />
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
                <div v-if="loggedIn" class="avatar" @click="openDrop=!openDrop">
                  <img src="/images/user.png" />
                  <i class="fa fa-caret-down" aria-hidden="true"></i>
                  <div class="dropdown" v-show="openDrop">
                    <ul>
                      <router-link tag="li" :to="{name:'dashboard'}">Account Settings</router-link>
                      <router-link tag="li" :to="{name:'logout'}">Logout</router-link>
                    </ul>
                  </div>
                </div>
                <div v-else class="log-sign">
                  <router-link tag="a" :to="{name:'access.signup'}">Sign up</router-link>
                  <router-link tag="a" :to="{name:'access.signin'}">Sign in</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="nav-c nav-bottom">
          <div class="row">
            <div class="col-md-6">
              <div class="left-b" v-if="$route.name==='home'">
                <div class="culture">
                  <h1>FASTEST GROWING</h1>
                  <h1>PROPERTY HUB</h1>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="right">
                <div v-if="loggedIn">
                  <router-link
                    tag="button"
                    class="btn btn-primary pr-4 pl-4"
                    :to="{name:'new-list'}"
                    :class="{'active':$route.name=='new-list'}"
                  >List your space</router-link>
                  <router-link
                    tag="button"
                    class="btn btn-primary"
                    :class="{'active':$route.name=='new-request'}"
                    :to="{name:'new-request'}"
                  >Need a space?</router-link>
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
    <transition
      enter-active-class="animated slideInLeft"
      leave-active-class="animated slideOutLeft"
    >
      <side-bar v-show="drawer"></side-bar>
    </transition>
    <!-- Close Drawer View -->
  </div>
</template>

<script>
import SideBar from "./SideBar";
import { mapGetters } from "vuex";

export default {
  components: {
    SideBar
  },
  data() {
    return {
      tReveal: false,
      drawer: false,
      openDrop: false
    };
  },
  methods: {
    openDrawer() {
      this.drawer = !this.drawer;
    }
  },
  watch: {
    $route() {
      this.drawer = false;
      this.openDrop = false;
    }
  },
  created() {
    let tis = this;
    document.addEventListener("scroll", function() {
      tis.tReveal = window.scrollY < 200 ? false : true;
    });
    window.eventBus.$on("openDrawer", this.openDrawer);

    console.log("====================================");
    console.log(process.env.MIX_API_URL);
    console.log("====================================");
  },

  computed: {
    ...mapGetters(["user", "loggedIn"])
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
  overflow: hidden;
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

  & .log-sign {
    & a {
      padding: 10px;
      font-weight: 700;
      text-decoration: none;
    }
  }

  & .avatar {
    cursor: pointer;
    margin-left: 10px;
    & .dropdown {
      background: #fff;
      line-height: 20px;
      color: #444;
      z-index: 999;
      border-radius: 3px;
      padding: 10px;
      width: 200px;
      position: absolute;
      ul {
        margin: 0px;
        padding: 0px;

        & li {
          list-style: none;
          padding: 10px;
          border-bottom: 1px solid #ccc;
          cursor: pointer;

          &:hover {
            background: #eef4ff;
          }
        }
      }
    }
  }
}
.nav-bottom {
  height: 100px;
  & .right {
    display: flex;
    justify-content: space-between;
    line-height: 100px !important;
  }

  & .left-b {
    display: block;
    line-height: 100px !important;

    & .culture {
      transform: translateX(-10px);
      line-height: 100px !important;
      margin-top: 15px;
      & h1 {
        font-size: 24px;
        line-height: 20px;
        color: #444;
        font-weight: 700;
      }
    }
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
    display: grid;
    grid-template-columns: 10% 30% 60%;
    align-items: center;

    & .bar {
      height: 30px;
      width: 30px;
      color: #3490dc;
      background: white;
      border-radius: 15px;
      text-align: center;
      font-size: 20px;
      line-height: 30px;
      margin: 0px 30px;
      cursor: pointer;
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