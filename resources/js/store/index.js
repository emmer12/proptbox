import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import mutations from "./mutations"
import actions from "./actions"
import getters from "./getters"
import state from "./state"
export const store =new Vuex.Store({
    state,
    mutations,
    actions,
    getters
}) 