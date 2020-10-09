<template>
  <div class="other-pages d-none-sm">

       <div class="pages">
          <router-link tag="div" to="/about">About
              <i class="fa fa-angle-right" aria-hidden="true"></i> 
          </router-link>
          <router-link tag="div" to="/terms">Our Policy
              <i class="fa fa-angle-right" aria-hidden="true"></i> 
          </router-link>
          <!-- <router-link to="">Report</router-link> -->
          <!-- <router-link tag="div" to="">Contact
              <i class="fa fa-angle-right" aria-hidden="true"></i> 
          </router-link> -->
          
       </div> 

  </div>
</template>

<script>
export default {

};
</script>



<style lang="scss" scoped>
  .pages{
      display: flex;
       margin-top: 10px;
       flex-direction: column;
       padding: 10px;

       div{
               background: white;
                padding: 20px 10px;
                margin-bottom: 5px;
                cursor: pointer;
                font-size: 16px;

                i{
                    font-size:30px;
                    float:right;
                    color: #ccc;
                }
       }
  }
</style>