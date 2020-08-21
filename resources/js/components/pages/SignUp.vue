<template>
  <div class="signup-con">
     <div class="container">
       <form v-on:submit.prevent>
         <div class="form-group ">
           <label for="inputName" class="col-sm-1-12 col-form-label">Username</label>
           <div class="col-sm-1-12">
             <input type="text" class="form-control" name="inputName" v-model="newUser.username" id="inputName" placeholder="">
           </div>
         </div>
          <div class="form-group ">
           <label for="inputName" class="col-sm-1-12 col-form-label">Passsword</label>
           <div class="col-sm-1-12">
             <input type="password" class="form-control" name="inputName" id="inputName" v-model="newUser.password" placeholder="">
           </div>
         </div>
         <div class="form-group">
           <div class="">
             <button type="submit" class="btn btn-primary" @click="login">Action</button>
           </div>
         </div>
       </form>
     </div>
  </div>
</template>

<script>
// import { mapActions } from 'vuex'
export default {
  data() {
    return {
      value: true,
      newUser: {},
      loading: false,
      serverErrors: null,
      menu: false,
    };
  },

  methods: {
    register() {
        this.loading = true;
        this.$store
          .dispatch("registerUser", this.newUser)
          .then(() => {
            this.newUser = {};
            this.loading = false;
            this.$toast.success({
              title: "Registration successfull",
              message: "Please check your email to verify your account"
            });
            if (localStorage.getItem("visitor-buyer")) {
              this.$router.push({
                name: "myzobopage",
                params: JSON.parse(localStorage.getItem("visitor-buyer"))
              });
            } else {
              this.$router.push({ name: "zobo.list" });
            }
          })
          .catch(err => {
            alert();
            this.loading = false;
            if (err.response.data.global) {
              this.serverErrors =
                null || Object.values(err.response.data.errors);
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
</script>



<style lang="scss" scoped>

</style>