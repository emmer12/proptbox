<template>
  <div class="signup-con">
    <div class="container">
      <form v-on:submit.prevent ref="form">
        <div class="form-group">
          <label for="firstname" class="col-sm-1-12 col-form-label">Firstname <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              :class="{'is-invalid':$v.newUser.firstname.$error}"
              type="text"
              class="form-control"
              name="firstname"
              v-model.trim="$v.newUser.firstname.$model"
              id="firstname"
              placeholder="Firstname"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.firstname.required"
            >This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <label for="lastname" class="col-sm-1-12 col-form-label">Lastname  <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="text"
              :class="{'is-invalid':$v.newUser.lastname.$error}"
              class="form-control"
              name="lastname"
              v-model.trim="$v.newUser.lastname.$model"
              id="lastname"
              placeholder="Lastname"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.lastname.required"
            >This field is required</div>
          </div>
        </div>
        <div class="form-group">
          <label for="username" class="col-sm-1-12 col-form-label">Username  <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.username.$error}"
              name="username"
              v-model.trim="$v.newUser.username.$model"
              id="username"
              placeholder="Username"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.username.required"
            >This field is required</div>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-1-12 col-form-label">Email  <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="email"
              class="form-control"
              :class="{'is-invalid':$v.newUser.email.$error}"
              name="email"
              v-model.trim="$v.newUser.email.$model"
              id="email"
              placeholder="email"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.email.required">This field is required</div>
            <div class="invalid-feedback" v-if="!$v.newUser.email.email">Please enter a valid email</div>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-1-12 col-form-label">Passsword  <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="password"
              :class="{'is-invalid':$v.newUser.password.$error}"
              class="form-control"
              name="password"
              id="password"
              v-model.trim="$v.newUser.password.$model"
              placeholder="********"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.password.required"
            >This field is required</div>
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.password.minLength"
            >Password must be minimum of 6 character</div>
          </div>
        </div>

        <div class="form-group">
          <label for="c-password" class="col-sm-1-12 col-form-label">Confirm Passsword  <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="password"
              :class="{'is-invalid':$v.newUser.cPassword.$error}"
              class="form-control"
              name="c-password"
              id="c-password"
              v-model.trim="$v.newUser.cPassword.$model"
              placeholder="********"

            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.cPassword.required"
            >This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary" @click="register">Register</button>
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
</template>

<script>
// import { mapActions } from 'vuex'
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      value: true,
      newUser: {
        username: "",
        firstname: "",
        lastname: "",
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
      username: { required },
      firstname: { required },
      lastname: { required },
      email: { required, email },
      password: { minLength: minLength(6) },
      cPassword: { required }
    }
  },

  methods: {
     register() {
     this.$v.$touch();
      this.$refs.form.classList.remove('shake')
     if (this.$v.$invalid) {
        let tis=this
        setTimeout(function(){
         tis.$refs.form.classList.add('shake')
        },1000)
     }else{
        this.loading = true;
      this.$store
        .dispatch("registerUser", this.newUser)
        .then(() => {
          this.newUser = {};
          this.loading = false;         
            this.$router.push({ name: "access.signin" });
        })
        .catch(err => {
          this.loading = false;
          if (err.response.data.global) {
            this.serverErrors = null || Object.values(err.response.data.errors);
            this.$toast.error({
              title: "Server Error",
              message: "Opps! something went wrong"
            });
            window.scrollTo(0, 50);
          } else {
            this.$toast.error({
              title: "Server Error",
              message: err.response.data.msg
            });
          }

          this.newUser.password = "";
        });











        
     }
    }
  }
};
</script>



<style lang="scss" scoped>
.signup-con {
  max-width: 400px;
  margin: 0px auto;
  background: white;
  padding: 10px;
  position: relative;


  & label span{
    color:red;
    font-size:14px;
  }
}
</style>