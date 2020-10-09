<template>
   <div class="side-con">
       <div class="header">
          <router-link to="/" tag="div">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </router-link> 
          <div>Chat</div> 
       </div>
          
    
       <div class="body " :class="{added:activeChat}">
         <div class="chats" :class="{added:activeChat ? activeChat.id===chat.id : false}" v-for="(chat, index) in chats" :key="index" @click="setChat(chat.id)">
           <img class="img" :src="'/uploads/profile-images/'+chat.from.profile_pic_filename" >
           <div class="name">
               <!-- <span>{{ chat.list.list_type || 'Request'}}</span> -->
               <strong>{{chat.to.fullname}}</strong>
               <p>{{chat.msg.length ? chat.msg[chat.msg.length-1].msg : "Empty Message"}}</p>
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
            
        }
    },
    methods: {
       getChats(){
           this.$store.dispatch('getChats')
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
            'activeChat'
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
            height:80vh;
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