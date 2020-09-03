<template>
  <div class="signup-con ">
    
    <div class="header">
        <div class="logo">
            <img src="/images/logo.svg" />
        </div>
        <h4>Forgot Password</h4>
    </div>

     <form>
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
              placeholder="Enter your email address"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.email.required">This field is required</div>
            <div class="invalid-feedback " v-if="!$v.newUser.email.email">Please enter a valid email</div>
          </div>
        </div>

        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary btn-block" :disabled="loading" @click="requestPass">Request password reset</button>
          </div>
        </div>
     </form>



  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import { required,minLength,email } from 'vuelidate/lib/validators'
export default {
  components:{
    Loading
  },
  data() {
    return {
      valid: true,
      newUser: {
        email:''
      },
      serverError: false,
      loading: false,
      success:false,
    };
  },
   validations:{
      newUser:{
        email:{
          required,
          email
        },
        }
      },
  methods: {
    requestPass() {
        this.loading = true;
        this.$store
          .dispatch("resetPasswordRequest", this.newUser)
          .then(() => {
            this.newUser = {};
            this.loading = false;
            this.success=true
           alert('sent')
          })
          .catch(err => {
            this.loading = false;
            this.serverError=err.response.data.msg;
           alert('error')
          });
      }
  }
};
</script>



<style lang="scss" scoped>
</style>