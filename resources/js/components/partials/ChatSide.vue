<template>
   <div class="side-con">
       <div class="header">
          <router-link to="/" tag="div">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </router-link> 
          <div>Chat</div> 
       </div>
          
    
       <div class="body" :class="{added:activeChat}">
        
         <div v-if="loading">
             <p>loading...</p>
         </div>
         <div v-else style="height:100%">
              <div v-if="!chats.length" class="empty-chat">
             <div >
                <div>
                    <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                   </svg>
                    <h4>No ongoing chat yet</h4>
                </div>
             </div>
         </div>
         <div v-else>
         <div class="chats" :class="{added:activeChat ? activeChat.id===chat.id : false}" v-for="(chat, index) in chats" :key="index" >
           <router-link tag="div" :to="{name:'profile',params:{id:(user.id==chat.from.id ) ? chat.to.id : chat.from.id }}">
            <img class="img" :src="'/uploads/profile-images/'+((user.id==chat.from.id ) ? chat.to.profile_pic_filename : chat.from.profile_pic_filename)" >
           </router-link>
           <div class="name" @click="setChat(chat.id)">
               <!-- <span>{{ chat.list.list_type || 'Request'}}</span> -->
               <strong>{{(user.id==chat.from.id ) ? chat.to.fullname : chat.from.fullname }}</strong>
               <p v-if="chat.msg[chat.msg.length-1].msg.length>40">{{chat.msg.length ? chat.msg[chat.msg.length-1].msg.substr(0,40) + '...'  : "Empty Message"}}</p>
               <p v-else>{{chat.msg.length ? chat.msg[chat.msg.length-1].msg : "Empty Message"}}</p>
           </div>
         </div>
         </div>
         </div>
       
       </div>
   </div>
</template>


<script>

import {mapActions,mapGetters} from 'vuex'

export default {
    data() {
        return {
            loading:false
        }
    },
    methods: {
       getChats(){
           this.loading=true;
           this.$store.dispatch('getChats').then(()=>{
               this.loading=false
           }).catch(()=>{
               this.loading=false
           })
       },
       setChat(id){
           window.eventBus.$emit('setActive');
           this.$store.dispatch('setChat',id)
       },
       markChat(){
           this.$store.dispatch('markChat');
       }
    },

    mounted () {
        this.getChats();
        this.markChat()
    },
    created () {

    },
    computed: {
        ...mapGetters([
            'chats',
            'activeChat',
            'user'
        ])
    },
}
</script>

<style lang="scss" scoped>
   .side-con{
       background:white;
       width:400px;
       float:left;
       padding:10px;
       margin:10px;

       .empty-chat{
           position: relative;
            top: 50%;
            transform: translateY(-50% );
            color: #8691b75e;
            text-align: center;
       }

       .header{
           background: #3490dc;
            height: 70px;
            line-height: 71px;
            padding: 0px 10px;
            color: white;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            padding:0px 10px;

            i{
                font-size:24px;
            }
       }
        .body{
            height:90vh;
            overflow-y:scroll;
        }

       .chats{
               
            height: 70px;
            background: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition:0.3s;

            &:hover,.added{
                background:#eef4ff;
            }
            &.added{
                background:#eef4ff;
            }

           .img{
                   float: left;
                height: 50px;
                width: 50px;
                border-radius: 50%;
                background: #ccc;
                
            }

            .name{
                    margin-left: 18px;
                    color: #444;
                    padding: 10px;
                    left: 10px;
                    position: relative;
                    cursor: pointer;
            }

       }

   }

   @media (max-width: 560px){
         .side-con{
            width:100%;
                padding:0px;
                margin:0px;
            }

          .body{
              &.added{
                  display:none
              }
          }
       

   }
</style>