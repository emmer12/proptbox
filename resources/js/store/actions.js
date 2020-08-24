import Api from './../api/api'

export default {

    registerUser({ commit,rootState }, data) {
        return new Promise((resolve, reject) => {
            Api.registerUser(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    getUser({ commit }){
        return new Promise((resolve, reject) => {
            Api.getUser().then(res => {
                commit('setUser',res.data.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },



    getListing({ commit,state }){
        return new Promise((resolve, reject) => {
            Api.getListing(state).then(res => {
                commit('setListing',res.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },




    loginUser({commit}, data) {
        return new Promise((resolve, reject) => {
            Api.loginUser(data).then(res => {
               if(res.data.data.error){
                reject(res.data)
               }else{
                let token = res.data.data.access_token;
                localStorage.setItem('token', token)
                commit("retrieveToken",token)
                resolve(res)
               }
            }).catch(err => {
                reject(err)

            })
        })
    },

    emailVerification({commit}, data) {
        return new Promise((resolve, reject) => {
            Api.verifyEmail(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    destroyToken({getters,commit,rootState}){
        if (getters.loggedIn) {
            return new Promise((resolve)=>{
                    localStorage.removeItem('token')
                    commit("destroyToken",rootState)
                    resolve(true)
                })
                .catch(err=>{
                    console.log(err);
                    
                })
        }
    },



}