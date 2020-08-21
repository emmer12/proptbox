<template>
  <div class="signup-con">
    <div class="container">
      <form v-on:submit.prevent>
        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Email</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              name="inputName"
              v-model="newUser.email"
              id="inputName"
              placeholder
            />
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
              v-model="newUser.password"
              placeholder
            />
          </div>
        </div>
        <div class="form-group">
          <div class>
            <button type="submit" class="btn btn-primary" :disabled="loading" @click="login">Action</button>
          </div>
        </div>

        <div class="loading-overlay" v-show="loading">
          <svg
            width="50px"
            height="50px"
            viewBox="0 0 345.804 345.804"
            xml:space="preserve"
          >
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
export default {
  data() {
    return {
      value: true,
      valid: true,
      newUser: {},
      serverErrors: false,
      loading: false
    };
  },

  methods: {
    login() {
      this.loading = true;
      this.valid = false;
      this.$store
        .dispatch("loginUser", this.newUser)
        .then(() => {
          this.newUser = {};
          this.loading = false;
          this.$router.push({ name: "dashboard" });
        })
        .catch(err => {
          this.loading = false;
          this.newUser.password = "";
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
        });
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
    stroke-width: 20px;
    opacity:0.5
  }

@keyframes dash {
  to{
    stroke-dashoffset: 1000;
  }
}
</style>