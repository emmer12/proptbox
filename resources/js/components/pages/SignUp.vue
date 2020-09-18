<template>
  <div class="signup-con">

    <div class="header">
        <div class="logo">
            <img src="/images/logo.svg" />
        </div>
        <h4>Sign Up</h4>
    </div>
    <div class="container">
      <form v-on:submit.prevent ref="form">
       

        <div class="c-btn" @click="socialSignUp('google')"><img src="/svg/google.svg" width="18px" /> Continue with Google</div>
        <div class="c-btn"  @click="socialSignUp('facebook')"><img src="/svg/facebook.svg"  width="18px" /> Continue with Facebook</div>

        <loading :loading="loading"></loading>
        
        
         <div class="or">
         <span >or</span>
        </div>


        <div class="form-group">
          <label for="firstname" class="col-sm-1-12 col-form-label">Fullname <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              :class="{'is-invalid':$v.newUser.fullname.$error}"
              type="text"
              class="form-control"
              name="fullname"
              v-model.trim="$v.newUser.fullname.$model"
              id="fullname"
              placeholder="Fullname"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.fullname.required"
            >This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <label for="phone" class="col-sm-1-12 col-form-label">Phone Number <span>*</span></label>
          <div class="col-sm-1-12">
            <input
              type="number"
              :class="{'is-invalid':$v.newUser.phone.$error}"
              class="form-control"
              name="phone"
              v-model.trim="$v.newUser.phone.$model"
              id="phone"
              placeholder="phone"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.phone.required"
            >This field is required</div>
          </div>
        </div>
        <!-- <div class="form-group">
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
        </div> -->
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
          <div class="col-sm-1-12">
            <div class="form-group">
              <label for="location">Location</label>
              <select class="custom-select"  :class="{'is-invalid':$v.newUser.location.$error}" id="location" v-model.trim="$v.newUser.location.$model">
                <option selected value="">Select your Location</option>
                <option value="Lagos">Lagos</option>
                <option value="Ondo">Ondo</option>
                <option value="Oyo">Oyo</option>
              </select>
            </div>
            <div class="invalid-feedback" v-if="!$v.newUser.location.required">This field is required</div>
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
              :class="{'is-invalid':$v.newUser.password_confirmation.$error}"
              class="form-control"
              name="c-password"
              id="c-password"
              v-model.trim="$v.newUser.password_confirmation.$model"
              placeholder="********"

            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.password_confirmation.required"
            >This field is required</div>
             <div
              class="invalid-feedback"
              v-if="!$v.newUser.password_confirmation.sameAsPassword"
            >Password do not match</div>
          </div>
        </div>

        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary btn-block" @click="register">Register</button>
          </div>
        </div>

        <div>
          <router-link to="/signin">Already have an account ?</router-link>
        </div>

        <loading :loading="loading"></loading>



      </form>
    </div>
  </div>
</template>

<script>
// import { mapActions } from 'vuex'
import Loading from './../partials/FormLoading';
import { required, minLength, email,sameAs } from "vuelidate/lib/validators";
import { TimelineLite } from "gsap/all";


export default {
  components: {
    Loading
  },
  data() {
    return {
      value: true,
      newUser: {
        username: "",
        fullname: "",
        phone: "",
        email: "",
        location:'',
        password: "",
        password_confirmation: ""
      },
      loading: false,
      serverErrors: null,
      menu: false
    };
  },

  validations: {
    newUser: {
      // username: { required },
      fullname: { required },
      location: { required },
      phone: { required},
      email: { required, email },
      password: {required, minLength: minLength(6) },
      password_confirmation: { required,sameAsPassword:sameAs('password') }
    }
  },

  methods: {
    socialSignUp(provider){
        this.$store.dispatch('socialSignUp',provider).then((res)=>{
         if (res.data.url) {
              window.location.href = res.data.url
            }
        })
    },
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
            this.$router.push({ name: "complete.setup" });
        })
        .catch(err => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong please try again")
          this.newUser.password = "";
        })
        
     }
    }
  },

    mounted() {
    // let get=this.$ref.get
    let timeline = new TimelineLite();
    // timeline.from(".signup-con", { y: 200, opacity: 0 });
    // timeline.from(".form-h", { x: -20, opacity: 0 });
  } 
};
</script>



<style lang="scss">
.signup-con {
  max-width: 400px;
  margin: 0px auto;
  background: white;
  padding: 10px;
  position: relative;
  transform: translateY(100px);
 & .header{
    text-align:center;
   & h4{
     background:#eef4ff
    }
  }

  & label span{
    color:red;
    font-size:14px;
  }
}

@media screen and (max-width:460px) {
  .signup-con{
    margin:10px;
  }
}
</style>

<style >
   .or{
     text-align:center;
     font-size:16px;
     background:#eef4ff;
     /* padding:5px; */
     border-radius: 50%;
     color:#3490dc;
     height:30px;
     width:30px;
     line-height:30px;
     left:50%;
     position:relative;
     transform:translateX(-50%)
   }
</style>