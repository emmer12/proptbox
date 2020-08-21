<template>
  <div>
          
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
       this.$store.dispatch('getUserByUsername',this.$route.params.username).then((res)=>{
       this.$store.dispatch("getProfileFollow", { uid: res.data.user._id }).then(res=> {
         this.follower=res.data.follower
         this.following=res.data.following
         this.loading=false
       })
    })
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