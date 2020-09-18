<template>
  <div>
      Profile ....  
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  components: {
  },
  data() {
    return {
      loading: true,
      pageNotFound: false,
      
    };
  },
  methods: {
    getUser(){      
    }
  },
  watch: {
    $route() {
      this.getUser();
    }
  },

  mounted () {
    this.loading=true
    // this.getUser()
  },

  computed: {
    //  ...mapGetters({isLoggedIn:'loggedIn',user:'user',profile:'profile'})
  }
};
</script>

<style lang="scss" scoped>
 
</style>