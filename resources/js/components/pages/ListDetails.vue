<template>
   <div class="contain">
     <div class="banner">
     </div>

     <div class="d-contain">
         <div class="d-inner">
             <div class="des-header1" v-show="true">
                 <div class="display">
                     <img src="/images/5.jpg" width="100%" height="300px"/>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>Ojoolape moses</h4>
                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatu </p>
                     </div>
                     <span>
                         <i class="fa fa-commenting-o"></i>
                     </span>
                     <div>
                         <button class="btn btn-primary">$500</button>
                     </div>
                 </div>
             </div>

              <div class="des-header2" v-show="false">
                 <div class="display">
                     <img src="/images/5.jpg" width="180px" height="180px"/>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>Ojoolape moses</h4>
                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatu </p>
                     </div>
                     <div class="comment">
                         <i class="fa fa-commenting-o"></i>
                     </div>
                     <div>
                         <button class="btn btn-primary">$500</button>
                     </div>
                 </div>
             </div>

             <div class="des-body">
                 <div class="body-details">
                     <div>Rent</div>
                     <div>$50 every month</div>
                 </div>
                  <div class="body-details">
                     <div>Bills</div>
                     <div>Not Included</div>
                 </div>
                  <div class="body-details">
                     <div>Security deposit</div>
                     <div>House</div>
                 </div>
                  <div class="body-details">
                     <div>Property type</div>
                     <div>Rent</div>
                 </div>
                  <div class="body-details">
                     <div>Room funishing</div>
                     <div>Unfonished</div>
                 </div>
                  <div class="body-details">
                     <div>Available on</div>
                     <div>August 28</div>
                 </div>


                 <hr>

                 <div class="des">
                     <div>
                         <strong>About space</strong>
                     </div>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur voluptatibus, nesciunt eum tenetur reprehenderit voluptas corrupti provident doloremque aliquid quos laudantium saepe magni fugiat expedita doloribus exercitationem omnis sit libero?</p>
                 </div>

                 <div class="des">
                     <img src="/images/user.png" width="50px" height="50px" style="border-radius:25px" />
                     <span>Lorem ipsum dolor sit ame</span>
                 </div>
                 <div class="des">
                     <div>
                         <strong>About the co sharers</strong>
                     </div>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur voluptatibus, nesciunt eum tenetur reprehenderit voluptas corrupti provident doloremque aliquid quos laudantium saepe magni fugiat expedita doloribus exercitationem omnis sit libero?</p>
                 </div>


                  <p style="padding:0px 50px">Number varified</p>
             </div>
             
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

    & .d-contain{
        max-width:600px;
        background:white;
        margin:0px auto;
        transform: translateY(-50px);
        // margin:10px;

    & .d-inner{
        max-width:100%;
        margin:0px auto;
        padding:10px;
       
       & .des-header2{
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
               & .comment{
                   position:absolute;
                   top:0px;
                   right:0px;
                   & i{
                   color: #334499;
                   font-size: 28px;
                   
               }
               }
           }
       }
       & .des-header1{
           & .display{
               border-bottom:8px solid #3490dc;
           }

           & .c-t-a{
               display: flex;
               flex-direction:row;
               padding:50px 50px 10px 50px;
               justify-content: space-between;  
              & span {
                   float:right;
                   margin-left: 100px;
                   padding:0px 10px;
               & i{
                   color: #334499;
                   font-size: 28px;
                   
               }
               }
               & .details{
                   width:60%;
                   
                   & h4{
                       font-size: 24px;
                       font-weight: 700;
                       color:#455
                   }
               }
           }
       }
    }

    & .des-body{
          & .body-details,.des{
            padding:10px 50px;

     }   
        & .body-details{
            // padding:10px;
            display: flex;
            &:nth-child(even){
                background: white;
            }
            &:nth-child(odd){
                background: #eef4ff;
            }
            & div{
                width:50%;
            }
        }
    }

}
}
</style>