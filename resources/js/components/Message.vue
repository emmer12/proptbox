<template>
  <div class="message" v-if="open">
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close"  @click="close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ msg }}</strong> 
      </div>
 </div>
</template>

<script>
export default {
    props:['msg'],
    data() {
        return {
            open:true 
     }
    },
    methods: {
    close(){
            this.open=false
        }
    },
}
</script>

<style lang="scss" scoped>
   .message{
       position:fixed;
       right:0px;
       bottom:80px;
       max-width:400px;
       z-index:999

   }
</style>