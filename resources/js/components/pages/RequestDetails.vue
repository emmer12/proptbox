<template>
   <div class="contain"  v-if="!notFound">
     <div class="banner">
     </div>

     <div v-if="request" class="d-contain">
         <div class="d-inner">
              <div class="des-header2" v-show="true">
                 <div class="display">
                     <router-link tag="div" :to="{name:'profile',params:{id:request.user.id}}">
                       <img :src="'/uploads/profile-images/'+request.user.profile_pic_filename" width="180px" height="180px"/>
                     </router-link>
                 </div>
                 <div class="c-t-a">
                     <div class="details">
                         <h4>{{request.user.fullname}}</h4>
                         <p>looking for an {{ request.space_type}} </p>
                     </div>
                    
                     <div>
                         <button class="btn btn-custom" style="cursor:default">&#8358; {{request.min_budget + "-" + request.max_budget}}</button>
                     </div>
                 </div>
                   <button ref="ccs" type="button" class="btn btn-primary btn-lg d-none" data-toggle="modal" data-target="#modelId"></button>
                  <div class="comment" style="cursor:pointer" v-if="!loading"  @click="openChat">
                         <svg width="40" height="52" viewBox="0 0 51 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.3353 16.4267L33.998 16.1492C35.0432 16.1328 35.9037 16.9666 35.9201 18.0118C35.9365 19.0571 35.1027 19.9175 34.0575 19.9339L16.3948 20.2115C15.3495 20.2279 14.4891 19.394 14.4727 18.3488C14.4563 17.3035 15.2901 16.4431 16.3353 16.4267Z" fill="#0D50BD"/>
                            <path d="M16.4545 23.9965L34.1171 23.719C35.1624 23.7026 36.0228 24.5364 36.0393 25.5817C36.0557 26.6269 35.2219 27.4874 34.1766 27.5038L16.5139 27.7813C15.4687 27.7977 14.6082 26.9639 14.5918 25.9186C14.5754 24.8734 15.4092 24.0129 16.4545 23.9965Z" fill="#0D50BD"/>
                            <path d="M16.5731 31.5661L34.2358 31.2886C35.281 31.2722 36.1415 32.106 36.1579 33.1512C36.1743 34.1965 35.3405 35.0569 34.2953 35.0734L16.6326 35.3509C15.5873 35.3673 14.7269 34.5335 14.7105 33.4882C14.694 32.443 15.5279 31.5825 16.5731 31.5661Z" fill="#0D50BD"/>
                            <path d="M24.917 0.391477C38.656 0.17562 50.0096 11.178 50.2255 24.917C50.2745 28.0389 49.7485 31.1023 48.6594 34.0282C47.8125 36.2758 46.6765 38.3461 45.2753 40.1992L48.7973 48.1104C49.0798 48.7446 48.9923 49.4816 48.5701 50.0321C48.2145 50.4959 47.6698 50.7637 47.0983 50.7727C46.9905 50.7744 46.8812 50.7673 46.7724 50.7494L33.8679 48.7059C31.305 49.6699 28.56 50.1806 25.6999 50.2255C11.9608 50.4413 0.607299 39.439 0.391442 25.7C0.175586 11.9609 11.1779 0.607335 24.917 0.391477ZM25.6405 46.4407C28.2198 46.4002 30.6799 45.9161 32.9522 45.0014C33.2701 44.8734 33.617 44.8332 33.9549 44.8879L43.9219 46.4664L41.3501 40.6899C41.0558 40.0289 41.1643 39.2574 41.6294 38.703C43.1022 36.9485 44.2756 34.9268 45.1139 32.7008C46.036 30.2249 46.4822 27.6259 46.4406 24.9765C46.2575 13.3242 36.6288 3.99327 24.9764 4.17635C13.3241 4.35942 3.99324 13.9882 4.17631 25.6405C4.35938 37.2928 13.9881 46.6238 25.6405 46.4407Z" fill="#0D50BD"/>
                        </svg>
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
                     <div>{{ request.space_for}}</div>
                 </div>
                  <div class="body-details">
                     <div>Budget</div>
                     <div>&#8358; {{request.min_budget + '-' + request.max_budget}}</div>
                 </div>

                 <hr>
                  <div class="des">
                     <div v-if="request.space_type!=='apartment'">
                         <strong>About Cohabitant</strong>
                     </div>
                     <p>{{ request.about_cohabitation }}</p>
                 </div>

                 <hr>

                 <div class="des">
                     <div>
                         <strong>About space</strong>
                     </div>
                     <p>{{request.about_property}}</p>
                <div v-if="request.user.reveal_contact">
                    <a :href="'tel:'+request.user.phoneNo"> <i class="fa fa-phone" aria-hidden="true"></i> {{ request.user.phoneNo }}</a>
                </div>
                 </div>


             </div>
             
         </div>


  
     </div>

     <div v-else>
      <preloader :type="'details'"></preloader>
     </div>

               <!-- Modal -->
     <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Start Chat</h5>
                         <button type="button" ref="ccc" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                 </div>
                 <div class="modal-body">
                       <div class="form-group">
                         <label for="">Message</label>
                         <input type="text" name="" id="" v-model="msg" class="form-control" placeholder="Send Message" required aria-describedby="helpId">
                         <small id="helpId" class="text-muted"></small>
                       </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" :disabled="loading" @click="createChat"> <span v-if="loading"><i class="fa fa-spinner" aria-hidden="true"></i> </span> Send</button>
                 </div>
             </div>
         </div>
     </div>

   </div>
   <div v-else class="container">
        <div class="alert alert-info" role="alert">
          <strong><i class="fa fa-wind-warning    "></i> Page not found</strong>
      </div>
      <router-link to="/listings" tag="button" class="btn btn-primary"> Go back Listing</router-link>
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
          notFound:'',
          availableChat:null,
          startChat:false,
          msg:"",
          loading:''  
        }
    },
    methods: {
      getRequestById(){
         this.$store.dispatch('getRequestById',this.$route.params.id).then(()=>{
              this.ckeckChat();
          }).catch((res)=>{
         this.notFound=res.response.data.message
       });
      },
       createChat(){
        let data={}
        data.to= this.request.user.id
        data.on=this.request.id+'request'
        data.msg=this.msg
        this.loading=true
      this.$store.dispatch('createChat',data).then(()=>{
        this.loading=false
        this.msg=''
        this.$refs.ccc.click()
        this.$router.push({ name: "chats" });

      }).catch(()=>{
           this.loading=false;
            this.msg='';
            this.$snotify.error("Opps, something went wrong")
      })
    },
      ckeckChat(){
           if (this.loggedIn) {
              let data={}
          data.to= this.list.user.id
          data.on=this.list.id
         
              this.loading=true;
             this.$store.dispatch('checkChat',data).then((res)=>{
              this.loading=false
              if (!res.data.chats) {
                  this.availableChat=null;
              }else{
                  this.availableChat=res.data.chats
              }
          })
          }else{
              this.availableChat=null
          }
      },
       openChat(){
          if (this.loggedIn) {
              if (this.availableChat) {
                  this.$store.dispatch('setChat',this.availableChat.id);
                  this.$router.push({ name: "chats" });
              }else{
                  this.startChat=true;
                  this.$refs.ccs.click()
              }      
          }else{
              this.$snotify.info("Sign up to start chat with"+this.request.user.fullname, {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true,
               closeOnClick: false,
                buttons: [
                    {text: 'Sign up', action: () =>this.$router.push('/signup'), bold: true}]
            });
          }
      },
    },
    created () {
     this.getRequestById();
     window.scrollTo(0,0)
    },
    computed:{
        ...mapGetters([
            'request',
            'loggedIn'
        ])
    }
}
</script>

<style lang="scss" scoped>

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

               .details p{
                   color:#0ca93f
               }
              
           }
            & .comment{
                  position: absolute;
                top: 10px;
                right: 15px;
                cursor:pointer;
                   & i{
                   color: #334499;
                   font-size: 28px;
                   
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
            
            & a{
                color:white;
                padding:10px;
                font-weight:700;
                line-height: 4;
                background: #3490dc;
                border: 2px solid white;
                border-radius: 11px;
                text-decoration: none;
            }

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


<style lang="scss" scoped>
    
@media (max-width:460px){
    
.contain {
& .banner{
    height:100px;
    background: #eef4ff;
}
 & .d-contain{
    margin: 0px 10px;
     transform: translateY(-40px);
     & .d-inner .des-header2 .display{
          & img{
              height:100px;
              width:100px;
          }
      }
     svg{
         height:30px;     }
    & .des-body{
        & .body-details{
                padding:10px 20px;

        }   
    }
       }

}
}

</style>