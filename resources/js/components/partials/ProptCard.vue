<template>
  <div style="height:1000px">
      <!-- <strong class="anim">
        Hello 
      </strong> -->



     <div class="container">
       <div class="row">
         <div class="col-md-4" v-for="(item, index) in 4" :key="index">
            <div class="card p-card">
              <div class="img">
                <img :src="'/images/'+ (item + 1) +'.jpg'" width="100%"/>
              </div>

              <div class="details">
                  <div class="title">
                    <h4>This is the title</h4>
                    <button v-if="item%2==0" class="btn btn-danger btn-sm">For rent</button>
                    <button v-else class="btn btn-primary btn-sm">For sale</button>
                  </div>
                  <div class="l-p">
                    <h4>Location pof prop</h4>
                    <h5>$5000</h5>
                  </div>
                  <div class="description">
                    <h4>title of des</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae tenetur natus tempore impedit esse enim!...</p>
                  </div>
                  <hr>
                  <div class="c-t-a">
                      <span class="mr-2"><i class="fa fa-eye"></i> </span>
                      <span class=""><i class="fa fa-commenting-o"></i> </span>
                  </div>
              </div>
            </div>
         </div>
       </div>
     </div>

     
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
 .p-card{
   padding:10px;
   margin-bottom:20px;
   & .img img{
     border-radius:5px;
   }
   & .details{
     border:1px solid #f6f6f6;
     border-radius: 3px;
     margin-top:10px;
     padding:5px;
     & .title{
       & h4{
          font-size: 22px !important;
       }
     }
     & .title,.l-p{
         display: flex;
         justify-content: space-between;
         align-items:center;
        //  padding: 5px 10px;

         & h4{
           color:#222;
           font-size:18px;
          //  font-weight: bolder;
         }
     }


     & .l-p{
       padding-top:10px;
       & h4{
           color:rgba($color: #000000, $alpha: 0.5);
           font-size:16px;
          // margin-left:-5px
         }
      }

    & .description{
        & h4{
          color:#444;
          font-size: 18px;
          // font-weight: bolder;
        }
    }

    & .c-t-a{
      display: flex;
      justify-content: flex-end;
      & span{
        color:grey;
        font-size:20px;
        margin:0px 10px;
      }
    }
     
   }
 }
</style>

<style lang="scss">
.anim{
  padding:10px 20px;
  background:#fff;
  width:130px;
  font-size: 20px;
  position:relative;
  overflow: hidden;
  margin:50px;
  color: #5895f9;
  box-sizing: border-box;

  &::after{
    content: "";
    height:100%;
    width:50%;
    background:rgba($color: #ffffff, $alpha:0.8);
    position:absolute;
    top:0px;
    left: 0px;
    animation:load 0.5s infinite alternate
    
  }

  @keyframes load {
    from{
      transform: translateX(0%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
      border-left: 2px solid #5895f9; 
    }
    to{
      transform: translateX(100%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
    }
  }


}
</style>