<template>
  <div class>
    <div class="banner"></div>
    <div class="container settings" v-if="user">
       <router-link :to="{name:'settings'}" tag="div" class="back">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
       </router-link>
      <div class="row">
        <div class="col-md-4">
          <div class="profile">
            <div v-if="imgLoading" class="loading">
              <span>
                <i class="fa fa-spinner" aria-hidden="true"></i>
              </span>
            </div>
            <label for="pro-image" style="cursor:pointer">
              <img :src="'/uploads/profile-images/'+user.profile_pic_filename" />
              <i class="fa fa-camera" aria-hidden="true"></i>
            </label>
            <input type="file" id="pro-image" style="display:none" @change="processFormImg" />
            <!-- <i class="fa fa-camera-retro" aria-hidden="true"></i> -->
          </div>
        </div>

        <div class="col-md-8">
          <div class="update">
           
            <div class="header">
              <h4>Edit Profile</h4>
            </div>
            <form v-on:submit.prevent ref="form" v-if="user">
              <div class="form-group">
                <label for="fullname" class="col-sm-1-12 col-form-label">
                  Fullname
                  <span>*</span>
                </label>
                <div class="col-sm-1-12">
                  <input
                    type="text"
                    class="form-control"
                    name="fullname"
                    v-model="user.fullname"
                    id="fullname"
                  />
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-1-12">
                  <div class="form-group">
                    <label for="location">Location</label>
                    <select class="custom-select" id="location" v-model="user.location">
                      <option selected :value="user.location">{{user.location}}</option>
                      <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-1-12 col-form-label">
                  Phone number
                  <span>*</span>
                </label>
                <div class="col-sm-1-12">
                  <input
                    type="text"
                    class="form-control"
                    name="phoneNo"
                    v-model="user.phoneNo"
                    id="phoneNo"
                  />
                </div>
              </div>

              <div class="form-group">
                <label for="bio">Bio</label>
                <textarea v-model="user.bio" class="form-control" id="bio" cols="20" rows="5" placeholder="Brief description about yourself"></textarea>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-1-12 col-form-label">
                  Email
                  <span>*</span>
                </label>
                <div class="col-sm-1-12">
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    v-model="user.email"
                    id="email"
                  />
                </div>
              </div>

          

              <div class="form-group ma-5">
                <div class>
                  <button type="submit" class="btn btn-primary btn-block" @click="update">Update</button>
                </div>
              </div>
              <div class="loading-overlay" v-show="loading">
                <svg width="50px" height="50px" viewBox="0 0 345.804 345.804" xml:space="preserve">
                  <g>
                    <path
                      id="path"
                      d="M343.288,159.838L181.905,27.941c-5.242-4.283-12.77-4.283-18.009,0l-41.336,33.79V44.193c0-3.788-3.066-6.848-6.854-6.848
		H75.928c-3.788,0-6.854,3.063-6.854,6.848v61.251L2.516,159.838c-2.933,2.391-3.36,6.711-0.97,9.641
		c1.357,1.654,3.33,2.523,5.32,2.523c1.524,0,3.053-0.511,4.328-1.545l34.55-28.245v172.011c0,3.785,3.066,6.852,6.846,6.852
		h240.626c3.781,0,6.854-3.066,6.854-6.852V142.216l34.55,28.245c1.273,1.037,2.807,1.545,4.326,1.545
		c1.984,0,3.956-0.87,5.314-2.524C346.648,166.549,346.221,162.235,343.288,159.838z M82.779,51.041h26.071v21.888l-26.071,21.31
		V51.041z M286.367,307.369H59.44V131.015l107.596-87.939c3.414-2.791,8.316-2.791,11.731,0l107.6,87.939V307.369z"
                    />
                  </g>
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                  <g />
                </svg>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="loading">
      <span>
        <i class="fa fa-spinner" aria-hidden="true"></i>
      </span>
    </div>
  </div>
</template>

<script>
import { required, minLength, email,sameAs } from "vuelidate/lib/validators";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      value: true,
      fileSeleted: "",
      loading: false,
      imgLoading: false,
      passLoading: false,
      serverErrors: null,
      menu: false
    };
  },
  methods: {
    update() {
      this.loading = true;
      this.$store
        .dispatch("updateUser", this.user)
        .then(() => {
          this.newUser = {};
          this.loading = false;
          this.$snotify.success("Updated", {
            timeout: 6000,
            showProgressBar: true,
            pauseOnHover: true
          });
        })
        .catch(err => {
          this.loading = false;
          this.$snotify.error(err.response.data.errors ?  Object.values(err.response.data.errors)[0][0] : "Opps, something went wrong please try again");
        });
    },

    getState(){
      this.$store.dispatch('getState')
    },
    processFormImg(e) {
      this.fileSeleted = e.target.files[0];
      this.uploadImage();
    },
    uploadImage() {
      this.imgLoading = true;
      this.$store
        .dispatch("uploadFile", this.fileSeleted)
        .then(() => {
            this.$snotify.success("Profile updated", { 
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true
            });
            this.imgLoading = false;
        })
        .catch(err => {
          this.serverErrors = err.response.data.msg;
          this.imgLoading = false;
        });
    },
  },
  created () {
    this.getState()
  },

  computed: {
    ...mapGetters(["user","states"])
  }
};
</script>

<style lang='scss' scoped>
.loading {
  position: absolute;
  left: 50%;
  transform: translate(-50%, 10px);
  & span i {
    animation: rot 1s infinite linear;
    transform-origin: center;
    color: grey;
    font-size: 30px;
  }
}
.banner {
  height: 50px;
  background: #eef4ff;
}
.settings {
  transform: translateY(-50px);
  z-index: 111;
  background: white;

  & .profile {
    height: 200px;
    width: 200px;
    border-radius: 50%;
    background: #eef4ff;
    margin: 0 auto;
    position: relative;
    & .loading {
      padding-left: 5px;
      position: absolute;
      top: 0;
      z-index: 999;
      left: 0;
      background: #3490dc69;
      width: 100%;
      height: 100%;
      border-radius: 0% 50%;
      & span i {
        animation: rot 1s infinite linear;
        transform-origin: center;
        color: white;
      }
    }

    & img {
      height: 200px;
      width: 200px;
      border-radius: 50%;
    }

    & i {
      position: absolute;
      bottom: 0px;
      right: 0px;
      font-size: 50px;
    }
  }
}
.update {
  max-width: 400px;
}
</style>
