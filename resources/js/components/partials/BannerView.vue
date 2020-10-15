<template>
  <div>
    <div class="banner-user" v-if="user">
      <div class="des-header2">
        <div class="display">
          <img
            :src="'/uploads/profile-images/'+user.profile_pic_filename"
            width="180px"
            height="180px"
          />
        </div>
        <div class="c-t-a">
          <div class="details">
            <h4>{{user.fullname}}</h4>
            <p>{{ user.gender}}, {{ user.age}}</p>
          </div>
        </div>

        <div class="action" v-if="loggedInUser && user.id==loggedInUser.id">
          <div class="comment" style="cursor:pointer" v-if="!loading"  @click="openChat">
                         <svg width="27" height="29" viewBox="0 0 51 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.3353 16.4267L33.998 16.1492C35.0432 16.1328 35.9037 16.9666 35.9201 18.0118C35.9365 19.0571 35.1027 19.9175 34.0575 19.9339L16.3948 20.2115C15.3495 20.2279 14.4891 19.394 14.4727 18.3488C14.4563 17.3035 15.2901 16.4431 16.3353 16.4267Z" fill="#0D50BD"/>
                            <path d="M16.4545 23.9965L34.1171 23.719C35.1624 23.7026 36.0228 24.5364 36.0393 25.5817C36.0557 26.6269 35.2219 27.4874 34.1766 27.5038L16.5139 27.7813C15.4687 27.7977 14.6082 26.9639 14.5918 25.9186C14.5754 24.8734 15.4092 24.0129 16.4545 23.9965Z" fill="#0D50BD"/>
                            <path d="M16.5731 31.5661L34.2358 31.2886C35.281 31.2722 36.1415 32.106 36.1579 33.1512C36.1743 34.1965 35.3405 35.0569 34.2953 35.0734L16.6326 35.3509C15.5873 35.3673 14.7269 34.5335 14.7105 33.4882C14.694 32.443 15.5279 31.5825 16.5731 31.5661Z" fill="#0D50BD"/>
                            <path d="M24.917 0.391477C38.656 0.17562 50.0096 11.178 50.2255 24.917C50.2745 28.0389 49.7485 31.1023 48.6594 34.0282C47.8125 36.2758 46.6765 38.3461 45.2753 40.1992L48.7973 48.1104C49.0798 48.7446 48.9923 49.4816 48.5701 50.0321C48.2145 50.4959 47.6698 50.7637 47.0983 50.7727C46.9905 50.7744 46.8812 50.7673 46.7724 50.7494L33.8679 48.7059C31.305 49.6699 28.56 50.1806 25.6999 50.2255C11.9608 50.4413 0.607299 39.439 0.391442 25.7C0.175586 11.9609 11.1779 0.607335 24.917 0.391477ZM25.6405 46.4407C28.2198 46.4002 30.6799 45.9161 32.9522 45.0014C33.2701 44.8734 33.617 44.8332 33.9549 44.8879L43.9219 46.4664L41.3501 40.6899C41.0558 40.0289 41.1643 39.2574 41.6294 38.703C43.1022 36.9485 44.2756 34.9268 45.1139 32.7008C46.036 30.2249 46.4822 27.6259 46.4406 24.9765C46.2575 13.3242 36.6288 3.99327 24.9764 4.17635C13.3241 4.35942 3.99324 13.9882 4.17631 25.6405C4.35938 37.2928 13.9881 46.6238 25.6405 46.4407Z" fill="#0D50BD"/>
                        </svg>
                     </div>
          <router-link
            :to="{name:'settings'}"
            tag="a"
          >
            <i class="fa fa-cog" aria-hidden="true"></i>
          </router-link>
        </div>

      <div class="verify-con" v-if="loggedInUser && user.id==loggedInUser.id">
                <h4>Verify Account</h4>
                <div class="verify">
                  <div class="v-icon" @click="verify('email')">
                    <i class="fa fa-envelope" :class="{active:user.email_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.email_verified_at"></span>
                  </div>
                  <div class="v-icon" @click="verify('id')" >
                    <i class="fa fa-user" aria-hidden="true" :class="{active:user.id_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.id_verified_at"></span>
                  </div>
                  <div class="v-icon" @click="verify('phone')">
                    <i class="fa fa-phone-square" aria-hidden="true" :class="{active:user.phone_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.phone_verified_at"></span>
                  </div>
                </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ['user'],
  data() {
    return {
      availableChat:null,
      startChat:false,
      msg:"",
      loading:'',
      notFound:"",

    }
  },
  methods: {
     createChat(){
        let data={}
        data.to=this.$route.params.id
        data.on='this.list.id'
        data.msg=this.msg
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
      openChat(){
          if (this.loggedIn) {
            if (this.loggedInUser.id==(this.$route.params.id || this.user.id)) {
               this.$router.push({ name: "chats" });
            }else{
                if (this.availableChat) {
                  this.$store.dispatch('setChat',this.availableChat.id);
                  this.$router.push({ name: "chats" });
              }else{
                  this.startChat=true;
                  this.$refs.ccs.click()
              }  
            }
          }else{
              this.$snotify.info("Sign up to start chat with"+this.user.fullname, {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true,
               closeOnClick: false,
                buttons: [
                    {text: 'Sign up', action: () =>this.$router.push('/signup'), bold: true}]
            });
          }
      },
      ckeckChat(){
          let data={}
          data.to=this.$route.params.id
          data.on='user'
          this.loading=true;
          this.$store.dispatch('checkChat',data).then((res)=>{
          this.loading=false
          if (!res.data.chats) {
              this.availableChat=null;
          }else{
              this.availableChat=res.data.chats
          }
        })
      },
      closeChat(){
          this.openChat=false
      }
  },
  created() {
    window.eventBus.$on('closeChat',this.closeChat);
  },
  mounted() {
     this.ckeckChat()
  },
  computed: {
    loggedInUser(){
      return this.$store.getters.user
    },
    loggedIn(){
      return this.$store.getters.loggedIn
    },

  }
};
</script>

<style lang="scss" scoped>
.banner-user {
  position: relative;
  & .des-header2 {
    background: white;
    display: flex;
    padding: 20px;
    margin-bottom: 10px;
    border-bottom: 8px solid #3490dc;
    & .display {
      & img {
        border-radius: 50%;
      }
    }

    & .c-t-a {
      padding-left: 20px;
      position: relative;
      padding-top: 70px;
      line-height: 20px;
    }

    & .action {
          position: absolute;
          top: 10px;
          display: flex;
          justify-content: space-between;
              align-items: center;
          width: 90%;

      a{
           font-size: 30px;
            font-weight: 600;

            &:hover{
              text-decoration:none;
            }
      }
    }
  }
}


   @media (max-width:460px) {
    .banner-user{

    & .des-header2 {
      display:block;
      text-align:center;
      padding-top: 50px;
      & .display {
        & img {
          width:100px;
          height:100px;
          border-radius: 50%;
        }
      }
      & .c-t-a {
          padding-left: 20px;
        padding-top: 15px;
        line-height: 12px;
      }
    }
   }
   }
</style>