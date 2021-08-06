<template>
  <div class="not-found">
      <h1>Page not found</h1>
      <router-link to="/" tag="button" class="btn btn-primary">Back to homepage</router-link >
  </div>
</template>

<script>
export default {

}
</script>

<style lang='scss' scoped>
 .not-found{
   text-align:center;
   padding:10px;


   h1{
     font-weight: 900;
     font-size: 2.4rem;
   }
 }
</style>