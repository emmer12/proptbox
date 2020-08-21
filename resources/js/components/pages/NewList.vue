<template>
   <div class="contain">
     <div class="banner">
     </div>
     <div class="c-list-con">
      <div class="c-list">
          <form action="">
              <div class="form-h">
                  <h4><span>List</span> your space ?</h4>
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

               <button class="btn btn-primary btn-block">Submit</button>
          </form>
      </div>
  </div>
   </div>
</template>

<script>
export default {

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