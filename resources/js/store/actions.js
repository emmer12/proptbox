import Api from './../api/api'

export default {

    registerUser({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.registerUser(data).then(res => {
                let token = res.data.access_token;
                localStorage.setItem('token', token)
                commit("retrieveToken",token)
                dispatch("getUser");
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    
    setupOther({ commit }, data) {
        return new Promise((resolve, reject) => {
            Api.setupOther(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },


    setupOtherSign({ commit }, data) {
        return new Promise((resolve, reject) => {
            Api.setupOtherSign(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },



    socialSignUp({ commit }, data) {
        return new Promise((resolve, reject) => {
            Api.socialSignUp(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },



    loginSocialCallback({commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.loginUpSocial(data,data.provider).then(res => {
               if(res.data.access_token){
                   let token = res.data.access_token;
                   localStorage.setItem('token', token)
                commit("retrieveToken",token)
                dispatch("getUser");
                resolve(res)
            }else{
                reject(res)
            }
            }).catch(err => {
                reject(err)

            })
        })
    },



    resetPasswordRequest({ commit }, data) {
        return new Promise((resolve, reject) => {
            Api.resetPasswordRequest(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },



    resetPassword({ commit }, data) {
        return new Promise((resolve, reject) => {
            Api.resetPassword(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    createList({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.createList(data).then(res => {
                dispatch('getUser');
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },


    deleteList({commit,dispatch},data){
        return new Promise((resolve, reject) => {
            Api.deleteList(data).then(res => {
                dispatch('getUser');
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    sendRequest({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.sendRequest(data).then(res => {
                dispatch('getUser');
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


    getListSlug({ commit },data){
        return new Promise((resolve, reject) => {
            Api.getListSlug(data).then(res => {
                commit('setListSlug',res.data.data);
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


    loginUser({commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.loginUser(data).then(res => {
               if(res.data.data.error){
                reject(res.data)
               }else{
                let token = res.data.data.access_token;
                localStorage.setItem('token', token)
                commit("retrieveToken",token)
                dispatch("getUser");
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

    setCurrentPos({commit},data){
         commit('setCurrentPos',data);
    },

    getRequestLimit({commit},data){
        return new Promise((resolve, reject) => {
            Api.getListing(state).then(res => {
                commit('getRequestLimit',res.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    }




}