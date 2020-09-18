<template>
  <div>
    <div class="nav d-none d-sm-block d-md-block" >
      <div class="container">
        <div class="nav-c nav-top" :class="{added:tReveal}">
          <div class="row">
            <div class="col-md-5 col-sm-10">
              <div class="left">
                <div class="bar" @click="openDrawer">
                  <i class="fa fa-bars"></i>
                </div>
                <router-link to="/" class="logo">
                  <img src="/images/logo.svg" />
                </router-link>
                </div>
              </div>
            <div class="col-md-4">
               <div class="mid">
                  <div>
                  <router-link
                    tag="button"
                    class="btn btn-primary pr-4 pl-4"
                    :to="{name: loggedIn ? 'new-list' : 'access.signin'}"
                    :class="{'active':$route.name=='new-list' }"
                  >List your space</router-link>
                  <router-link
                    tag="button"
                    class="btn btn-primary"
                    :class="{'active':'new-request'}"
                    :to="{name:loggedIn ? 'new-request' : 'access.signup'}"
                  >Need a space ?</router-link>
                </div>
            </div>
            </div>
            <div class="col-md-3 col-sm-2">
              <div class="right">
                <div class="s-icon" @click="sShow=!sShow"><i class="fa fa-search" aria-hidden="true"></i> </div>
                <div class="search-field" v-show="sShow">
                    <div class="form-group">
                      <select class="form-control" name="" v-model="sTerm" id="">
                        <option selected value="listing">Listing</option>
                        <option value="request">Request</option>
                      </select>
                    </div>
                   <input placeholder="Search" v-model="search" class="form-control" />
                   <div class="btn btn-primary" @click="submitSearch" style="height:40px;margin-left:5px"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
                <div v-if="loggedIn" class="avatar" @click="openDrop=!openDrop">
                  <img v-if="user" :src="'/uploads/profile-images/'+user.profile_pic_filename"  />
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
                
                <div class="avatar pl-4 d-none">
                  <img v-if="user" :src="'/uploads/profile-images/'+user.profile_pic_filename"  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-show="tReveal" style="margin-top:100px">Nav reveal test</div>
  

    <!-- Drawer View -->
    <transition v-if="loggedIn"
      enter-active-class="animated slideInLeft"
      leave-active-class="animated slideOutLeft"
    >
      <side-bar v-show="drawer" ></side-bar>
    </transition>
    <!-- Close Drawer View -->
     

     <div class="mobile-nav d-sm-none">
       <div class="top">
         <div>
             <router-link to="/" class="logo">
                  <img src="/images/logo.svg" />
                </router-link>
         </div>
         <div>
             <div class="left">
                  <router-link
                    tag="button"
                    class="btn btn-primary pr-4 pl-4"
                    :to="{name: loggedIn ? 'new-list' : 'access.signin'}"
                    :class="{'active':$route.name=='new-list' }"
                  >List</router-link>
                  <router-link
                    tag="button"
                    class="btn btn-primary"
                    :class="{'active':'new-request'}"
                    :to="{name:loggedIn ? 'new-request' : 'access.signup'}"
                  >Request</router-link>
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
    SideBar
  },
  data() {
    return {
      sShow:false,
      tReveal: false,
      drawer: false,
      openDrop: false,
      sTerm:"listing",
      search:''
    };
  },
  methods: {
    openDrawer() {
      this.drawer = !this.drawer;
    },
    submitSearch(){
      if (this.search!=='') {
        if (this.sTerm==="listing") {
              if (this.$route.query.search!==`${this.search}`) {
                this.$router.push({name:'list',query:{search:this.search}})
              }  
        }else{
           if (this.$route.query.search!==`${this.search}`) {
             this.$router.push({name:'request',query:{search:this.search}})
           }  
       }
      }else{
        return
      }
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
.mid {
   line-height: 70px;    
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
    position: relative;

    & .s-icon{
    padding: 0px 17px;
    font-size: 19px;
    cursor: pointer;
  }
    
    & .search-field{
         background: white;
        padding: 10px;
        position: absolute;
        top: 70px;
        z-index: 9999;
        display: flex;
        max-width: 400px;
        width: 400px;
        transform: translateX(-360px);
    }
    & img {
      height: 40px;
      width: 40px;
      border-radius: 20px;
      line-height: 70px;

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

    & .logo{
      line-height: 70px;
      
    }
    & .mid {
      margin: 0px 0px 0px 0px;
      display: flex;
      justify-content:center;
      margin-left:50px;
      line-height: 70px;
      & button {
        margin-right: 10px;
      }
    }
  }
  //   line-height: 50px;
}

.mobile-nav {
  .top{
    display:flex;
    height:70px;
    background:#eef4ff;
    line-height:70px;

    & .left{
      position: absolute;
      right: 10px;

      .s-icon{
        border:none;
        outline:none;
        font-size:16px;
        background:transparent
        
      }
   }
  }
}
</style>