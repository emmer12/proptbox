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
      states:[
        {name:"Abia"},
        {name:"Adamawa"},
        {name:"Akwa Ibom"},
        {name:"Anambra"},
        {name:"Bauchi"},
        {name:"Bayelsa"},
        {name:"Benue"},
        {name:"Borno"},
        {name:"Cross River"},
        {name:"Delta"},
        {name:"Ebonyi"},
        {name:"Edo"},
        {name:"Ekiti"},
        {name:"Enugu"},
        {name:"FCT - Abuja"},
        {name:"Gombe"},
        {name:"Imo"},
        {name:"Jigawa"},
        {name:"Kaduna"},
        {name:"Kano"},
        {name:"Katsina"},
        {name:"Kebbi"},
        {name:"Kogi"},
        {name:"Kwara"},
        {name:"Lagos"},
        {name:"Nasarawa"},
        {name:"Niger"},
        {name:"Ogun"},
        {name:"Ondo"},
        {name:"Osun"},
        {name:"Oyo"},
        {name:"Plateau"},
        {name:"Rivers"},
        {name:"Sokoto"},
        {name:"Taraba"},
        {name:"Yobe"},
        {name:"Zamfara"}
      ],
      chat:{
        activeChat:null,
        chats:[],
        messages:[]
      },
      onBoarding:JSON.parse(localStorage.getItem('board')) ?  false : true
    }
