<template>
   <div class="contain">
     <div class="banner">
     </div>

     <div v-if="request" class="d-contain">
         <div class="d-inner">
             <div class="des-header1" v-show="false">
                 <div class="display">
                     <img src="/images/5.jpg" width="100%" height="300px"/>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>{{request.space_type | capFirst}}</h4>
                         <p>{{ request.space_address}}</p>
                     </div>
                     <span>
                         <i class="fa fa-commenting-o"></i>
                     </span>
                     <div style="min-width:100px">
                         <button class="btn btn-primary">$ {{request.rent}}</button>
                     </div>
                 </div>
             </div>

              <div class="des-header2" v-show="true">
                 <div class="display">
                     <img src="/images/5.jpg" width="180px" height="180px"/>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>{{request.user.fullname}}</h4>
                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatu </p>
                     </div>
                     <div class="comment">
                         <i class="fa fa-commenting-o"></i>
                     </div>
                     <div>
                         <button class="btn btn-primary">${{request.rent}}</button>
                     </div>
                 </div>
             </div>

             <div class="des-body">
                 <!-- <div class="body-details">
                     <div>Rent</div>
                     <div>${{request.rent}} every month</div>
                 </div> -->
                  <div class="body-details">
                     <div>Property type</div>
                     <div>{{request.space_type}}</div>
                 </div>
                  <div class="body-details">
                     <div>Space Location</div>
                     <div>{{ request.space_location}}</div>
                 </div>
                  <div class="body-details">
                     <div>Space for</div>
                     <div>{{ space_for}}</div>
                 </div>
                  <div class="body-details">
                     <div>Available from</div>
                     <div>{{ request.available_from }}</div>
                 </div>

                   <div class="body-details">
                     <div>Payer Gender</div>
                     <div>{{ request.payer_gender }}</div>
                 </div>

                  <div class="body-details">
                     <div>Budget</div>
                     <div>{{ request.budget }}</div>
                 </div>


                 <hr>

                 <div class="des">
                     <div>
                         <strong>About space</strong>
                     </div>
                     <p>{{request.about_property}}</p>
                 </div>

                 <div class="des">
                     <img src="/images/user.png" width="50px" height="50px" style="border-radius:25px" />
                     <span>Lorem ipsum dolor sit ame</span>
                 </div>
                 <div class="des">
                     <div>
                         <strong>About cohabitation</strong>
                     </div>
                     <!-- <p>{{ request.about_cohabitation }}</p> -->
                 </div>


                  <p style="padding:0px 50px">Number varified</p>
             </div>
             
         </div>
     </div>

     <div v-else>
      <preloader :type="'details'"></preloader>
     </div>
   </div>
</template>

<script>
import { mapActions,mapGetters } from 'vuex'
import Preloader from "./../partials/ContentPreloader";

export default {
    components: {
        Preloader
    },
    data() {
        return {
            
        }
    },
    methods: {
      getRequestById(){
          this.$store.dispatch('getRequestById',this.$route.params.id)
      }
    },
    created () {
     this.getRequestById();
    },
    computed:{
        ...mapGetters([
            'request'
        ])
    }
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