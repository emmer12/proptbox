<template>
   <div class="contain">
     <div class="banner">
     </div>
     <div class="c-list-con">
      <div class="c-list">
          <form action="">
              <div class="form-h">
                  <h4><span>Request </span>for your space ?</h4>
              </div>
              <div class="form-group">
                  <label for="">Space Type</label>
                  <input placeholder="Space Type" class="form-control" />
              </div>

               <div class="form-group">
                  <label for="">Space Address</label>
                  <input placeholder="Space Address" class="form-control" />
              </div>
               <div class="form-group">
                  <label for="">Rent</label>
                  <input placeholder="Rent" class="form-control" />
              </div>
               <div class="form-group">
                  <label for="">Available Form</label>
                  <input placeholder="Available Form" class="form-control" />
              </div>
               <div class="form-group">
                  <label for="">Payer Gender</label>
                  <input placeholder="Space Type" class="form-control" />
              </div>
               <div class="form-group">
                  <label for="">Bedroom Type</label>
                  <input placeholder="Bedroom type" class="form-control" />
              </div>

               <div class="form-group">
                  <label for="">About Property</label>
                  <textarea placeholder="About Property"  class="form-control"></textarea> 
               </div>
              <div class="form-group">
                  <label for="">About Cohabitation</label>
                  <textarea placeholder="About Cohabitation"  class="form-control"></textarea> 
               </div>

               <button class="btn btn-primary btn-block">Request</button>
          </form>
      </div>
  </div>
   </div>
</template>

<script>
import {TimelineLite} from "gsap/all"
export default {
mounted(){
    // let get=this.$ref.get
    let timeline=new TimelineLite()
    timeline.from('.c-list-con',{y:50,opacity:0})
    timeline.from('.form-h',{x:-20,opacity:0})
  
}
}
</script>

<style lang="scss">

.contain{
    & .banner{
        height:50px;
        background: #eef4ff;
    }

    & .c-list-con{
        // margin:10px;
        max-width:500px;
        background:white;
        margin:0px auto;
        transform: translateY(-50px);

    & .c-list{
        max-width:400px;
        margin:0px auto;
        padding:10px;
           & .form-control{
               background: #eef4ff ;
           }

       & .form-h{
           padding:10px 10px 10px 0px;

            & span{
                color:#3490dc
            }
        }
        
    }


}
}
</style>