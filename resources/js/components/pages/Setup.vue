<template>
  <div class="signup-con">
     <div class="header">
        <div class="logo">
            <img src="/images/logo.svg" />
        </div>

        <div style="border-radius:50%">
          <img src="/images/user.png" height="100px" width="100px" style="border-radius:50%" />
        </div>
        <h5 style="margin:10px">Fow Steps to go</h5>
    </div>
    <div class="container">
      <form v-on:submit.prevent ref="form" :class="{shake:invalid}">
        <div class="alert alert-danger" v-if="serverErrors" role="alert">
          <strong>{{serverErrors}}</strong>
        </div>
        <div class="form-group ">
          <label for="inputName" class="col-sm-1-12 col-form-label">Phone Number</label>
          <div class="col-sm-1-12">
            <input
              type="number"
              class="form-control"
              :class="{'is-invalid':$v.newUser.phoneNo.$error}"
              name="inputName"
              v-model.trim="$v.newUser.phoneNo.$model"
              id="inputName"
              placeholder="Phone number"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.phoneNo.required">This field is required</div>
            <div class="invalid-feedback" v-if="!$v.newUser.minLength.required">Phone number must be at least 11 digit</div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-1-12">
            <div class="form-group">
              <label for="location">Location</label>
              <select class="custom-select"  :class="{'is-invalid':$v.newUser.location.$error}" id="location" v-model.trim="$v.newUser.location.$model">
                <option selected value="" disabled>Select your Location</option>
                <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
              </select>
            </div>
            <div class="invalid-feedback" v-if="!$v.newUser.location.required">This field is required</div>
          </div>
        </div>

          <div class="form-group ">
          <label for="inputName" class="col-sm-1-12 col-form-label">Age</label>
          <div class="col-sm-1-12">
            <input
              type="number"
              class="form-control"
              :class="{'is-invalid':$v.newUser.age.$error}"
              name="inputName"
              v-model.trim="$v.newUser.age.$model"
              id="inputName"
              placeholder="Your age"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.age.required">This field is required</div>
          </div>
        </div>

          <div class="form-group" >
            <label for="space_type">Gender</label>
            <select 
            v-model.trim="$v.newUser.gender.$model"
            :class="{'is-invalid':$v.newUser.gender.$error}"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option value="" selected disabled>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="others">Others</option>
            </select>
            <div class="invalid-feedback" v-if="!$v.newUser.gender.required">Gender is required</div>

          </div>

        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary btn-block" :disabled="loading" @click="finish">Finish</button>
          </div>
        </div>

        <loading :loading="loading"></loading>

      </form>
    </div>


  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import { required,minLength } from 'vuelidate/lib/validators'
export default {
  components: {
    Loading
  },
  data() {
    return {
      value: true,
      invalid: false,
      newUser: {
        phoneNo:'',
        location:'',
        age:'',
        gender:''
      },
      serverErrors: false,
      loading: false
    };


  },
    validations:{
      newUser:{
        phoneNo:{
          required,
          minLength: minLength(11)
        },
        location:{
          required
        },
        age:{
          required
        },
        gender:{
          required
        }
      }
    },
  methods: {
    finish() {
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
        .dispatch("setupOther", this.newUser)
        .then(() => {
          this.newUser = {};
          this.loading = false;
          this.$router.push({ name: "home" });
        })
        .catch(err => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong")
          console.log(err);
          
            this.serverErrors = err.response ? err.response.data.msg : "invalid cridential"
        });
      }
    },

     getState(){
      this.$store.dispatch('getState');
    },
  },

  mounted () {
    this.getState()
  },

  computed: {
     states(){
       return this.$store.getters.states;
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