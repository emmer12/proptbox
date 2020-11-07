<template>
  <div class="signup-con " style="margin:10px">
         <form  v-on:submit.prevent ref="form">
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
          </div>
        </div>

        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary btn-block" @click="sendResetPassword">Reset</button>
          </div>
        </div>

        <div>
          <router-link to="/signin">Already have an account ?</router-link>
        </div>

        <loading :loading="loading"></loading>



      </form>
  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import { required,minLength,email } from 'vuelidate/lib/validators'
import {mapActions} from 'vuex' 

export default {
  components:{
    Loading
  },
  data() {
    return {
      valid: true,
      newUser: {
        email:'',
        password:'',
        password_confirmation:''
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
        password:{
          required
        },
        password_confirmation:{
          required
        }
        
        }
      },

  methods: {
    ...mapActions({
                resetPassword: 'resetPassword',
            }),
            sendResetPassword() {
                    const token = this.$route.query.token;
                    this.resetPassword({...this.newUser, token})
                        .then(() => {
                                this.$router.push({name: 'access.signin'});
                                 this.$snotify.success("Your password has been succefully reset ")
                        }).catch(() =>{
                            this.$snotify.error("Opps, something went wrong.Please try again")
                    });
            },
  }
};
</script>



<style lang="scss" scoped>
</style>