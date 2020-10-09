<template>
  <div class="signup-con ">
    
    <div class="header">
        <div class="logo">
            <img src="/images/logo.svg" />
        </div>
        <h4>Forgot Password</h4>
    </div>

     <form>
       <div v-show="success" class="alert alert-primary alert-dismissible fade show" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           <span class="sr-only">Close</span>
         </button>
         <strong>Request sent succesfully</strong> Check your email address to continue.
       </div>
       <div v-show="serverError" class="alert alert-danger" role="alert">
         <strong>{{serverError}}</strong>
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
        this.serverError=false
        this.$store
          .dispatch("resetPasswordRequest", this.newUser)
          .then(() => {
            this.newUser = {
              email:''
            };
            this.loading = false;
            this.success=true
            this.$snotify.success("Request recieved")
          })
          .catch(err => {
            this.loading = false;
            this.serverError=err.response.data.response == 'passwords.user' ? `user with email Address ${this.newUser.email} not found` : "err.response.data.message";
            
           this.$snotify.error("Opps, something went wrong.Please try again")
          });
      }
  }
};
</script>



<style lang="scss" scoped>
</style>