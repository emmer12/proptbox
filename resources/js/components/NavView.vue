<template>
  <div>
    <div class="nav d-none d-sm-block d-md-block" >
      <div class="container">
        <div class="nav-c nav-top" :class="{added:tReveal}">
          <div class="row">
            <div class="col-md-4 col-sm-10">
              <div class="left">
                <!-- <div class="bar" @click="openDrawer">
                  <i class="fa fa-bars"></i>
                </div> -->
                <div v-if="$route.params.mobile">
                  <img src="/images/logo.svg" />
                </div>
                <router-link v-else to="/" class="logo">
                  <img src="/images/logo.svg" />
                </router-link>

                
                </div>
              </div>
               <router-link v-if="notify" :to="{name:'chats'}" tag="div" class="d-notification">
                <svg width="35" height="34" viewBox="0 0 16 16" class="bi bi-chat-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                  <path fill-rule="evenodd" d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                    <span v-if="notify && notify.length">{{ notify.length}}</span>
                </svg>
                <span v-if="notify.length">{{ notify.length }}</span>
              </router-link>
            <div class="col-md-4">
              
                 <div class="search-field" >
                    <div class="form-group">
                      <select class="form-control" name="" v-model="sTerm" id="">
                        <option selected value="listing">Listing</option>
                        <option value="request">Request</option>
                      </select>
                    </div>
                   <input placeholder="Search" v-model="search" class="form-control" />
                   <div class="btn search" @click="submitSearch" ><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>

                
              
            </div>

            <div class="col-md-4 col-sm-2">
              <div class="right">
                <div class="d-flex">
                  <router-link
                    tag="li"
                    class="pr-4 pl-4"
                    :to="{name:'list'}"
                    :class="{'active':$route.name=='list' }"
                  >Listings</router-link>
                  <router-link
                    tag="li"
                    class=""
                    :class="{'active':'request'}"
                    :to="{name:'request'}"
                  >Requests</router-link>
              </div> 
              <div v-if="loggedIn" >
                <div class="avatar" @click="openDrop=!openDrop">
                  <img v-if="user" :src="'/uploads/profile-images/'+user.profile_pic_filename"  />
                    <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                     <div class="dropdown" v-show="openDrop">
                    <ul>
                      <router-link tag="li" :to="{name:'settings'}">Settings</router-link>
                      <router-link v-if="user.isAdmin" :to="{name:'admin'}" tag="li">Admin Dashboard</router-link>
                      <router-link tag="li" :to="{name:'logout'}">Logout</router-link>

                    </ul>
                  </div>
                    </transition>
                </div>

                     <div class="create" @click="openDrop2=!openDrop2">
                    <i class="fa fa-plus"></i>
                    <transition enter-active-class="animated slideInRight" leave-active-class="animated slideOutRight">
                    <div class="dropdown" v-show="openDrop2">
                    <ul>
                      <router-link tag="li" :to="{name: loggedIn ? 'new-list' : 'access.signin'}">Create List</router-link>
                      <router-link :to="{name:loggedIn ? 'new-request' : 'access.signup'}" tag="li"> Create a request</router-link>

                    </ul>
                  </div>
                    </transition>
                  </div>
                               
              </div>  


              
                <div v-else class="log-sign">
                  <router-link tag="a" :to="{name:'access.signup'}" class="btn  btn-custom-2">Sign up</router-link>
                </div>

                 
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>

      
    <!-- Drawer View -->
    <transition v-if="loggedIn"
      enter-active-class="animated slideInLeft"
      leave-active-class="animated slideOutLeft"
    >
      <side-bar v-show="drawer" ></side-bar>
    </transition>
    <!-- Close Drawer View -->
     

     <div class="mobile-nav d-sm-none" :class="{added:tReveal}">
       <div class="top">
         <div>
             <router-link to="/" class="logo">
                  <img src="/images/logo.svg" width="80%" />
                </router-link>
         </div>
         <div>
            
                 <div v-if="!$route.params.mobile" class="create" @click="openDrop2=!openDrop2">
                    <i class="fa fa-plus"></i>
                    <transition enter-active-class="animated slideInRight" leave-active-class="animated slideOutRight">
                    <div class="dropdown" v-show="openDrop2">
                    <ul>
                      <router-link tag="li" :to="{name: loggedIn ? 'new-list' : 'access.signin'}">Create List</router-link>
                      <router-link :to="{name:loggedIn ? 'new-request' : 'access.signup'}" tag="li"> Create a request</router-link>

                    </ul>
                  </div>
                    </transition>
                </div>
             <!-- <div class="left">
                  <router-link
                    tag="button"
                    class="btn btn-primary btn-sm pr-4 pl-4"
                    :to="{name: loggedIn ? 'new-list' : 'access.signin'}"
                    :class="{'active':$route.name=='new-list' }"
                  >List</router-link>
                  <router-link
                    tag="button"
                    class="btn btn-primary btn-sm"
                    :class="{'active':'new-request'}"
                    :to="{name:loggedIn ? 'new-request' : 'access.signup'}"
                  >Request</router-link> -->
                <!-- <button class="s-icon" @click="sShow=!sShow"><i class="fa fa-search" aria-hidden="true"></i></button> -->

                <!-- <div class="search-field" v-show="sShow">
                  <div class="form-group">
                    <select class="form-control" name="" v-model="sTerm" id="">
                      <option selected value="listing">Listing</option>
                      <option value="request">Request</option>
                    </select>
                  </div>
                  <input placeholder="Search" v-model="search" class="form-control" />
                  <div class="btn btn-primary" @click="submitSearch" style="height:40px;margin-left:5px"><i class="fa fa-search" aria-hidden="true"></i></div>
              </div> -->
                </div>
         </div>

       </div>

       <div class="nav-bottom" v-if="!onBoarding" v-show="!['about','terms','list-details'].includes($route.name)">
          <div class="container">
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
                
                <div class="avatar pl-4 d-none">
                  <img v-if="user" :src="'/uploads/profile-images/'+user.profile_pic_filename"  />
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>

       <div class="bottom">
       </div>
     </div>

  </div>
</template>

<script>
import SideBar from "./SideBar";
import { mapGetters } from "vuex";

export default {
  components: {
    SideBar,
  },
  data() {
    return {
      sShow: false,
      tReveal: false,
      drawer: false,
      openDrop: false,
      openDrop2: false,
      sTerm: "listing",
      search: "",
    };
  },
  methods: {
    openDrawer() {
      this.drawer = !this.drawer;
    },
    submitSearch() {
      if (this.search !== "") {
        if (this.sTerm === "listing") {
          if (this.$route.query.search !== `${this.search}`) {
            this.$router.push({ name: "list", query: { search: this.search } });
          }
        } else {
          if (this.$route.query.search !== `${this.search}`) {
            this.$router.push({
              name: "request",
              query: { search: this.search },
            });
          }
        }
      } else {
        return;
      }
    },
  },
  watch: {
    $route() {
      this.drawer = false;
      this.openDrop = false;
    },
  },
  created() {
    let tis = this;
    document.addEventListener("scroll", function () {
      tis.tReveal = window.scrollY < 200 ? false : true;
    });
    window.eventBus.$on("openDrawer", this.openDrawer);

    console.log("====================================");
    console.log(process.env.MIX_API_URL);
    console.log("====================================");
  },

  computed: {
    ...mapGetters(["user", "loggedIn", "onBoarding"]),

    notify() {
      if (this.$store.getters.user) {
        let not = this.$store.getters.user.notifications;
        return not.filter((notif) => !notif.read_at);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.d-notification {
  position: fixed;
  right: 10px;
  bottom: 50px;
  background: #3490dc;
  height: 50px;
  width: 50px;
  line-height: 43px;
  border-radius: 50%;
  text-align: center;
  color: white;
  border: 2px solid white;
  cursor: pointer;
  z-index: 9999;

  i {
    color: white;
    font-size: 28px;
  }

  span {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #f44336;
    color: white;
    position: absolute;
    top: -10px;
    right: -4px;
    line-height: 20px;
    text-align: center;
  }
}
.nav {
  background-color: #3490dc;
  left: 0;
  top: 0;
  z-index: 999;
  position: relative;

  img {
    background: #d8e6fb;
    border-radius: 10px;
    object-fit: cover;
  }
}
.nav-top {
  position: relative;
  height: 70px;
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
    right: -70px;
    position: relative;
    & a {
      font-weight: 700;
      text-decoration: none;
    }
  }

  & .avatar {
    cursor: pointer;
    margin-left: 10px;
    transition: 0.2s;
    & .dropdown {
      background: #fff;
      line-height: 20px;
      color: #444;
      z-index: 9999;
      // border-radius: 12px;
      /* padding: 10px; */
      box-sizing: border-box;
      width: 200px;
      position: absolute;
      right: 0px;
      ul {
        margin: 0px;
        padding: 0px;

        & li {
          list-style: none;
          padding: 10px;
          display: block;
          cursor: pointer;
          transition: 0.2s;

          &:hover {
            background: #bfddfb;
          }
        }
      }
    }
  }
}
.mid {
  line-height: 70px;
}
.nav-bottom {
  height: 100px;
  position: relative;
  z-index: 7800;
  & .right {
    display: flex;
    justify-content: space-between;
    line-height: 100px !important;
    float: right;
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
   .right {
    float: right;
    line-height: 70px;
    display: flex;
    position: relative;

    & .s-icon {
      padding: 0px 17px;
      font-size: 19px;
      cursor: pointer;
    }
    & img {
      height: 40px;
      width: 40px;
      border-radius: 20px;
      line-height: 70px;
    }
    li{
      cursor: pointer;
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
      margin: 0px 0px;
      cursor: pointer;
    }

    & .logo {
      line-height: 70px;
    }
    & .mid {
      margin: 0px 0px 0px 0px;
      display: flex;
      justify-content: center;
      margin-left: 50px;
      line-height: 70px;
      & button {
        margin-right: 10px;
      }
    }
  }
  //   line-height: 50px;
}

.mobile-nav {
  transition: 0.3s ease-in;
  position: relative;
  &.added {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 999;
    width: 100%;
  }
  .top {
    display: flex;
    height: 70px;
    background: #eef4ff;
    line-height: 70px;

    & .left {
      position: absolute;
      right: 10px;

      .s-icon {
        border: none;
        outline: none;
        font-size: 16px;
        background: transparent;
      }
    }
  }
}

.search-field {
  padding: 10px;
  z-index: 999;
  display: flex;
  max-width: 400px;
  width: 400px;

  input {
    padding: 10px;
    height: 45px;
    border-radius: 0px;
  }
  select {
    height: 45px;
  }

  .search {
    height: 45px;
    background: #fff;
    color: #3490dc;
    font-size: 20px;
  }
}

.d-flex {
  display: flex;

  li {
    text-transform: uppercase;
    font-weight: 500;
  }
}

.btn-custom-2 {
  background: #1f6eaf;
  padding: 10px 20px;
  color: #fff;
}
.create {
  position: absolute;
  top: 16px;
  right: -80px;
  background: #e6eefb;
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  font-size: 18px;
  box-shadow: 1px 2px 3px #1e4f77;
  cursor: pointer;
  z-index: 999;

  .dropdown {
    background: white;
    width: 200px;
    right: 0px;
    position: absolute;
    top: 54px;
    text-align: left;

    ul {
      margin: 0px;
      padding: 0px;
      li {
        list-style: none;
        display: block;
        cursor: pointer;
        transition: 0.2s;
        font-size: 14px;
        padding: 0px 13px;

        &:hover {
          background: #bfddfb;
        }
      }
    }
  }
}

@media (max-width: 600px) {
  .create {
    right: 14px;
    box-shadow: 1px 2px 3px #c1cde2;
  }
}
</style>