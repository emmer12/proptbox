<template>
   <div class="container chat-con">
      <div class="side-bar ">
          <chat-side></chat-side>
      </div>
      <div class="main"  :class="{added:activeChat}">
          <chat></chat>                                                                 <!-- <chat v-if="openChat" :user="user" ></chat> -->
      </div>
   </div>
</template>

<script>
import ChatSide from './../partials/ChatSide'
import Chat from './Chat'
import {mapGetters} from 'vuex'

export default {
    components: {
        ChatSide,
        Chat
    },
    data () {
        return {
            openChat:true
        }
    },

    computed: {
    ...mapGetters([
        'activeChat',
        'user'
      ])
    },

}
</script>

<style lang="scss" scoped>
.chat-con{
   .main{
       margin-left:400px;
       transition: 0.3s;
   }
}
@media (max-width: 560px){
      .chat-con{
          padding:0px;
        .main{
            &.added{
                    position: absolute;
                    top: 0px;
                    margin-left: 0px;
                    width: 100%;
                
            }
        }
   
}

   }
</style>