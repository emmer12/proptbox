<template>
    <div style="padding:20px">
    <div v-if="loading" class="loading">
      <span>
        <i class="fa fa-spinner" aria-hidden="true"></i>
      </span>
    </div>

    <div class="alert alert-success" role="alert" v-if="success">
        <strong>Email address verified successfully</strong>
        <p>You will be redirected in few seconds to complete you accoun settings.</p>
    </div>


    <div class="alert alert-danger" v-if="error" role="alert">
        <strong>Opps invalid token.., please make sure signup properly</strong>
    </div>
    
    </div>
</template>

<script>
export default {
 data () {
     return {
         loading:false,
         success:false,
         error:false
     }
 },
 created(){
     this.loading=true;
     this.$store.dispatch("emailVerification",this.$route.query).then(()=>{
     this.loading=false
     this.success=true
     let that=this 
     setTimeout(()=>{
         that.$router.push({name:'complete.setup'});
     },10000)
   }).catch(()=>{
       this.loading=false,
       this.error=true
   })
   }
}
</script>

<style lang="scss" scoped>
.loading {
    text-align:center;
      & span i {
        animation: rot 1s infinite linear;
        transform-origin: center;
        color: grey;
        font-size: 40px;
      }
    }
</style>