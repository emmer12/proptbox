<template>
    <div style="padding:20px">
        <h1>Verifying Email</h1>
    </div>
</template>

<script>
export default {
 created(){
   this.$store.dispatch("emailVerification",this.$route.query).then(()=>{
    this.$router.push({name:'session.signin'});
   })
   }
}
</script>

<style>

</style>