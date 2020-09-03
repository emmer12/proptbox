<template>
  <div class>
    <div class="banner"></div>
    <div class="container settings">
      <div class="row">
        <div class="col-md-4">
          <div class="profile">
            <img src="/images/user.png" />
            <i class="fa fa-camera" aria-hidden="true"></i>
            <!-- <i class="fa fa-camera-retro" aria-hidden="true"></i> -->
          </div>
        </div>

        <div class="col-md-8">
          <div class="update">
            <div class="header">
              <h4>Account Setting</h4>
            </div>
            <form v-on:submit.prevent ref="form">
              <div class="form-group">
                <label for="firstname" class="col-sm-1-12 col-form-label">
                  Fullname
                  <span>*</span>
                </label>
                <div class="col-sm-1-12">
                  <input
                    :class="{'is-invalid':$v.newUser.fullname.$error}"
                    type="text"
                    class="form-control"
                    name="firstname"
                    v-model.trim="$v.newUser.fullname.$model"
                    id="firstname"
                    :placeholder="user.fullname"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="!$v.newUser.fullname.required"
                  >This field is required</div>
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-sm-1-12 col-form-label">
                  Location
                  <span>*</span>
                </label>
                <div class="col-sm-1-12">
                  <input
                    type="text"
                    :class="{'is-invalid':$v.newUser.location.$error}"
                    class="form-control"
                    name="location"
                    v-model.trim="$v.newUser.location.$model"
                    id="location"
                    :placeholder="user.location"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="!$v.newUser.location.required"
                  >This field is required</div>
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
                    :class="{'is-invalid':$v.newUser.phoneNo.$error}"
                    name="phoneNo"
                    v-model.trim="$v.newUser.phoneNo.$model"
                    id="phoneNo"
                    :placeholder="user.phoneNo"
                    
                  />
                  <div
                    class="invalid-feedback"
                    v-if="!$v.newUser.phoneNo.required"
                  >This field is required</div>
                </div>
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
                    :class="{'is-invalid':$v.newUser.email.$error}"
                    name="email"
                    v-model.trim="$v.newUser.email.$model"
                    id="email"
                   :placeholder="user.email"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="!$v.newUser.email.required"
                  >This field is required</div>
                  <div
                    class="invalid-feedback"
                    v-if="!$v.newUser.email.email"
                  >Please enter a valid email</div>
                </div>
              </div>

              <div class="verify">
                <h4>Verify Account</h4>

                <i class="fa fa-facebook active"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-envelope active" aria-hidden="true"></i>
                <i class="fa fa-phone" aria-hidden="true"></i>
              </div>
              <div class="form-group">
                <div class>
                  <button type="submit" class="btn btn-primary" @click="update">Update</button>
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
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";
import { mapGetters } from 'vuex'
export default {
  data() {
    return {
      value: true,
      newUser: {
        phoneNo: "",
        fullname: "",
        location: "",
        email: "",
        password: "",
        cPassword: ""
      },
      loading: false,
      serverErrors: null,
      menu: false
    };
  },

  validations: {
    newUser: {
      phoneNo: { required },
      fullname: { required },
      location: { required },
      email: { required, email },
      password: { minLength: minLength(6) },
      cPassword: { required }
    }
  },

  methods: {
    update() {
      alert("yerss");
    },
  },

  computed: {
    ...mapGetters([
      'user'
    ])
  },
};
</script>

<style lang='scss' scoped>
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
    margin:0 auto;
    position:relative;
    & img {
        width:100%;
      border-radius: 50%;
    }

    & i{
        position: absolute;
        bottom:0px;
        right:0px;
        font-size:50px;
    }
  }
}
.update {
  max-width: 400px;

  & .verify {
    background: #f6f6f6;
    padding: 10px;

    & i {
      background: grey;
      padding: 10px;
      margin: 20px 10px;
      font-size: 20px;
      border-radius: 10px;
      color: white;
      &.active {
        background: #0d50bd;
      }
    }
  }
}
</style>

<style lang="scss">
    .header {
      & h4{
    color: #444;
    padding: 10px 0px;
      }
  }
</style>