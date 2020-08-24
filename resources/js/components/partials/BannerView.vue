<template>
  <div class="banner">
               <div class="des-header2">
                 <div class="display">
                     <img src="/images/5.jpg" width="180px" height="180px"/>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>Ojoolape moses</h4>
                         <p>Male,31</p>
                     </div>
                 </div>
             </div>
    </div>
</template>

<script>
export default {
    methods: {
        
    }
};
</script>

<style lang="scss" scoped>
.banner{
  & .des-header2{
           background:white;
           display:flex;
           padding:20px;
           margin-bottom:10px;
            border-bottom:8px solid #3490dc;
           & .display{
               & img{
                   border-radius:50%;
               }
           }

           & .c-t-a{
               padding-left:20px;
               position:relative;
               padding-top: 40px;
               line-height:20px;
              
           }
       }
}

</style>