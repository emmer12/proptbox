<template>
  <div class="signup-con">
     <div class="header">
        <div class="logo">
            <img src="/images/logo.svg" />
        </div>
        <h4>Login</h4>
    </div>
    <div class="container">
      <form v-on:submit.prevent ref="form" :class="{shake:invalid}">
        <div class="alert alert-danger" v-if="serverErrors" role="alert">
          <strong>{{serverErrors}}</strong>
        </div>
        <div class="form-group ">
          <label for="inputName" class="col-sm-1-12 col-form-label">Email</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.email.$error}"
              name="inputName"
              v-model.trim="$v.newUser.email.$model"
              id="inputName"
              placeholder="Email address"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.email.required">This field is required</div>
            <div class="invalid-feedback " v-if="!$v.newUser.email.email">Please enter a valid email</div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Passsword</label>
          <div class="col-sm-1-12">
            <input
              type="password"
              class="form-control"
              name="inputName"
              id="inputName"
              :class="{'is-invalid':$v.newUser.password.$error}"
              v-model.trim="$v.newUser.password.$model"
              placeholder="********"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.password.required">This field is required</div>
          </div>
        </div>

        <div class="f-password">
          <router-link tag="span" :to="{name:'access.forget.password'}" class="primary-color">forgot password?</router-link>
        </div>
        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary btn-block" :disabled="loading" @click="login">Sign in</button>
          </div>
        </div>

        <div style="text-align:center">
         <span >or</span>
        </div>

        <div class="c-btn"><img src="/svg/google.svg" width="18px" @click="socialSignUp('google')" /> Continue with Google</div>
        <div class="c-btn"><img src="/svg/facebook.svg" width="18px"  @click="socialSignUp('facebook')" /> Continue with Facebook</div>

        
        <div>
          <router-link to="/signup" tag="strong" style="cursor:pointer">Don't have an account ?</router-link>
        </div>

        <loading :loading="loading"></loading>

        
        
      </form>

    </div>


  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import { required,minLength,email } from 'vuelidate/lib/validators'
export default {
  components: {
    Loading
  },
  data() {
    return {
      value: true,
      invalid: false,
      newUser: {
        email:'',
        password:''
      },
      serverErrors: false,
      loading: false
    };


  },
    validations:{
      newUser:{
        email:{
          required,
          email
        },
        password:{
          required
        }
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
    login() {
      this.$v.$touch()
      this.$refs.form.classList.remove('shake')
      if (this.$v.$invalid) {
        // this.invalid=true;
        let tis=this
        setTimeout(function(){
         tis.$refs.form.classList.add('shake')
        },1000)
      }else{
      this.valid = false;
      this.loading = true;
           this.$store
        .dispatch("loginUser", this.newUser)
        .then(() => {
          this.newUser = {};
          this.loading = false;
          this.$snotify.success("Login successful", {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true
            });
          this.$router.push({ name: "home" });

        })
        .catch(err => {
          this.loading = false;
          this.newUser.password = "";
          this.$snotify.error("Opps, something went wrong")
          console.log(err);
          
            this.serverErrors = err.response ? err.response.data.msg : "invalid cridential"
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
  transform: translateY(100px);
  & .header{
    text-align:center;
   & h4{
     background:#eef4ff
    }
  }
}
</style>

<style lang="scss">
.loading-overlay {
  top: 0px;
  left: 0px;
  position: absolute;
  height: 100%;
  width: 100%;
  background: rgba(254, 255, 255, 0.7);
  text-align:center;
  line-height:150px;
  transition:0.5s;

}
 #path{
    stroke-dasharray: 50;
    stroke:white;
    animation:dash 5s linear infinite;
    stroke-width: 30px;
    opacity:0.8;
    fill:#3490dc;
  }

  .shake{
    animation:shake 1s;
  }
  .f-password{
    & span{
      float:right;
      padding:10px 0px;
    }
  }

@keyframes dash {
  to{
    stroke-dashoffset: 1000;
    fill:#3490dc;
  }
}
</style>

<style lang="scss" >
  .c-btn{
    display:block;
    padding:10px;
    background:#eef4ff;
    text-align:center;
    border-radius:5px;
    margin:5px 0px;
    cursor:pointer;
    transition:0.3s;
    &:hover{
      background:#3490dc;
      color:white;
      font-weight:700

    }
  }
</style>