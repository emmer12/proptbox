<template>
  <div class="chat-con" v-if="activeChat">
    <div class="header">
      <div @click="clearActive">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
      </div>
    </div>
      

      <div class="body" id="bbody"> 
         <div class="chats" >
             <div class="chat-box" v-for="(message, index) in messages" :key="index" :class="{right:message.user_id==user.id}">
                 <div class="msg " >
                    {{ message.msg }}
                 </div>
             </div>
             <div class="chat-box right"  v-if="loading" >
                 <div class="msg " style="background:#9e9e9e61;color: #666;">
                    loading...
                 </div>
             </div>
         </div>
      </div>

      <div class="footer">
        <input v-model="msg" type="text" placeholder="">
        <button class="btn btn-primary " style="border-radius: 50%;" :disabled="!msg.length || loading" @click="submitChat"><i class="fa fa-send-o" aria-hidden="true"></i> </button>
      </div> 
  </div>
  
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  data() {
    return {
      msg:'',
      chats:[],
      chatList:[],
      newChat:'',
      loading:false
    }
  },

  methods: {
    submitChat(){
      let data={}
      data.chat_id=this.activeChat.id;
      data.to=(this.user.id === this.activeChat.to.id) ? this.activeChat.from.id : this.activeChat.to.id;
      data.msg=this.msg;
      this.loading=true;
      this.scrollT()
      this.$store.dispatch('sendChat',data).then((res)=>{
        this.loading=false;
      let el=document.getElementById('bbody');
        this.$store.dispatch('getChats');
        this.messages.push(res.data.msg);
        let that=this
        setTimeout(()=>{
           that.scrollT()
        },100)

        this.msg='';
      })
    },
    scrollT(){
       let el=document.getElementById('bbody');
         let scrollH=el.scrollHeight;
          el.scrollTop=scrollH
    },
    createChat(){
      let data={}
      data.to=this.user.id;
      data.on=this.$route.params.id;
      data.newChat=this.msg;
      
      this.$store.dispatch('createChat',data).then((res)=>{
        this.loading=false;
        this.newChat=''
        this.activeChat=res.data.chats
      })
    },
    listen(){
    
      Echo.private('chat.'+this.activeChat.id).listen('NewChat',(res)=>{
        if (res.chat.user_id!==this.user.id) {
          this.messages.push(res.chat);
        }
        this.scrollT()
        
})
    },
  clearActive(){
    this.$store.dispatch('clearActive');
  },
  },
  created() {
    window.eventBus.$on('setActive',()=>{
      setTimeout(() => {
      this.listen(); 
         let el=document.getElementById('bbody');
         let scrollH=el.scrollHeight;
         el.scrollTop=scrollH 
      }, 100);
    });

  },

   mounted () {
    
    },

    computed: {
      ...mapGetters([
        'activeChat',
        'messages',
        'user'
      ])
    },

}
</script>

<style lang="scss" scoped>
  .chat-con{
   top: 20px;
    position: relative;
    // z-index: 9999;
    // display: flex;
    // flex-direction: column;
    .header{
      background: #3490dc;
      display: flex;
      justify-content: space-between;
      padding: 10px;
      height: 70px;
      align-items: center;

      i,span{
        color: white;
        font-size: 20px;
        cursor: pointer;
      }
      h4{
        color: white;
      }

    }
    .body{
     flex-grow: 1;
     background: #eef4ff;
     position:relative;
     flex-grow: 1;
     display: flex;
    background: #eef4ff;
    flex-direction: column;
    height:500px;
  overflow-y: scroll;
  // overflow-x: hidden;
    &::-webkit-scrollbar{
        background:#eef4ff;
        width:5px;
      }

      &::-webkit-scrollbar-thumb{
        background:#3490dc;
        border-radius:2.5px
      }
      .new-chat{
        top: 50%;
        position: relative;
        transform: translateY(-50%);
        text-align: center;
        margin: 12px;

        button{
          margin-top:10px;
        }
      }
      .chats{
             transition: 0.3s;
            right: 0%;
            position: absolute;
            width: 100%;
            // height: 80vh;
            // display: flex;
            // flex-direction: column;
            // justify-content: flex-end;
      }
     .chat-box{
       
       display:flex;justify-content:flex-start;min-height:50px;margin:10px 15px;animation:.65s ease-out 0s show;color:white;
      //  line-height:13px;
      //  position: relative;
      //  bottom: 0px;
      //  line-height: 13px;
      //   bottom: 0px;
      //   padding: 10px;
      //   background: #3490dc;
      //   margin: 10px;
      //   border-radius: 10px;
      //   color: white;
      //   max-width: 70%;

      &.right{
        text-align:right;justify-content:flex-end;

        .msg{
        background:#3490dc;color:#fff;border-top-right-radius:0;border-top-left-radius:5px}.message-container.right .message::before{border-top-color:#3490dc;border-left-color:#3490dc;border-right-color:transparent;left:auto;right:-7px;
        }
      }
      .msg{
        background:#fff;border-radius:5px;border-top-left-radius:0;box-sizing:border-box;color:#b3b2ca;height:100%;padding:10px 15px;position:relative;
      }

      span{
         font-size: 80%;
        font-weight: 400;
        position: absolute;
        color: #b6bfe2;
        bottom: -19px;
        right: 10px;
      }

      
     }
    }
    .footer{
      display: flex;

      input{
        padding:green;
        flex-grow: 1;
        background: #fff;
        border: none;
        border-bottom: 1px solid #3490dc;
        outline: none;
        padding-left: 10px;
        padding: 10px;
      }
      div{
        padding:10px;
        background: #3490dc;
        cursor: pointer;
        i{
          color:#fff;
        }
      }
    }

  }
</style>