import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default {
      token:localStorage.getItem('token') || null,
      user: JSON.parse(localStorage.getItem('user')) || null,
      space:[],
      request:[],
      hRequest:[],
      listing:{
        list:[],
        links:null,
        meta:null,
      },
      profile:null,
      position:null,
      listDetails:null,
      requestDetails:null,
      listingTags:[],
      states:[],
      chat:{
        activeChat:null,
        chats:[],
        messages:[]
      },
      onBoarding:JSON.parse(localStorage.getItem('board')) ?  false : true
    }
