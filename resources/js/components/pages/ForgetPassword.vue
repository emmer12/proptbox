<template>
  <div class="signup-con ">
    <h1>Forgot Passweord</h1>
  </div>
</template>

<script>
export default {
  data() {
    return {
      valid: true,
      newUser: {},
      serverError: false,
      loading: false,
      success:false,
    };
  },

  methods: {
    requestPass() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.$store
          .dispatch("resetPasswordRequest", this.newUser)
          .then(() => {
            this.newUser = {};
            this.loading = false;
            this.success=true
            this.$toast.success({
              title: "hey!,You are welcome Tunner",
              message: "Email has been sent"
            });
          })
          .catch(err => {
            this.loading = false;
            this.serverError=err.response.data.msg;
            this.$toast.error({
              title: "Server Error",
              message:err.response.data.msg
            });
          });
      } else {
        alert("error!!!");
      }
    }
  }
};
</script>



<style lang="scss" scoped>
</style>