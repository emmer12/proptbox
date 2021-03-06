import Api from './../api/api'

export default {

    registerUser({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.registerUser(data).then(res => {
                // let token = res.data.access_token;
                // localStorage.setItem('token', token)
                // commit("retrieveToken",token)
                // dispatch("getUser");
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    updateUser({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.updateUser(data).then(res => {
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

       updateList({ dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.updateList(data).then(res => {
                dispatch("getListing");
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
                commit("retrieveToken",token);
                commit("setBoard");
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

    deleteUser({dispatch},data){
        return new Promise((resolve, reject) => {
            Api.deleteUser(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    deleteRequest({dispatch},data){
        return new Promise((resolve, reject) => {
            Api.deleteRequest(data).then(res => {
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

    sendChat({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.sendChat(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    
    makePayment({}, data) {
        return new Promise((resolve, reject) => {
            Api.makePayment(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    createChat({ commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.createChat(data).then(res => {
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

    getAllUsers({ commit }){
        return new Promise((resolve, reject) => {
            Api.getAllUsers().then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    
    getAllListings({ commit }){
        return new Promise((resolve, reject) => {
            Api.getAllListings().then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    
    getAllRequests({ commit }){
        return new Promise((resolve, reject) => {
            Api.getAllRequests().then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    
    getAllBoosted({ commit }){
        return new Promise((resolve, reject) => {
            Api.getAllBoosted().then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    
    getUserById({ commit },data){
        console.log(data);            
        return new Promise((resolve, reject) => {
            Api.getUserById(data).then(res => {
                commit('setFUser',res.data.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    checkChat({ commit },data){
        return new Promise((resolve, reject) => {
            Api.checkChat(data).then(res => {
                console.log(res);
                
                // commit('checkChat',res.data.data);
                resolve(res)

            }).catch(err => {
                reject(err)
    
            })
        })
    },
    getChats({ commit },data){
        return new Promise((resolve, reject) => {
            Api.getChats(data).then(res => {
                commit('setChats',res.data.data);
                resolve(res)

            }).catch(err => {
                reject(err)
    
            })
        })
    },
    setChat({ commit,dispatch },data){
        return new Promise((resolve, reject) => {
                commit('setActive',data);
                dispatch("getUser");
            }).catch(err => {
                reject(err)
            })
    },

    markChat({ commit }){
        return new Promise((resolve, reject) => {
            Api.markChat().then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)
    
            })
        })
    },

    clearActive({ commit }){
        return new Promise((resolve, reject) => {
                commit('clearActive');
            }).catch(err => {
                reject(err)
            })
    },

    changePass({dispatch},data){
        return new Promise((resolve, reject) => {
            Api.changePass(data).then(res => {
                dispatch("getUser");
                resolve(res);
            }).catch(err => {
                reject(err)
    
            })
        })
    },


    getTags({ commit }){
    return new Promise((resolve, reject) => {
        Api.getTags().then(res => {
            commit('setTags',res.data.data);
            resolve(res)
        }).catch(err => {
            reject(err)

        })
    })
},
    getListId({ commit },data){
        return new Promise((resolve, reject) => {
            Api.getListId(data).then(res => {
                commit('setListId',res.data.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },


    getListing({ commit,state },data){
        return new Promise((resolve, reject) => {
            Api.getListing(state,data).then(res => {
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

    emailVerification({commit,dispatch}, data) {
        return new Promise((resolve, reject) => {
            Api.verifyEmail(data).then(res => {
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

    sendOtp({commit}) {
        return new Promise((resolve, reject) => {
            Api.sendOtp().then(res => {
                resolve(res,commit)
            }).catch(err => {
                reject(err)
            })
        })
    },
    verifyOtp({dispatch},data) {
        return new Promise((resolve, reject) => {
            Api.verifyOtp(data).then(res => {
                dispatch("getUser");
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
                    localStorage.removeItem('user')
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

    getRequestLimit({commit,state},data){
        return new Promise((resolve, reject) => {
            Api.getRequestLimit(state).then(res => {
                commit('setHRequest',res.data.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    getRequest({commit,state},data){
        return new Promise((resolve, reject) => {
            Api.getRequest(state,data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)
            })
        })
    },


    getRequestById({ commit },data){
        return new Promise((resolve, reject) => {
            Api.getRequestById(data).then(res => {
                commit('setRequestById',res.data.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    getState({commit},data){
        return new Promise((resolve, reject) => {
            Api.getState().then(res => {
                commit('setStates',res.data);
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    selectTag({},data){
        return new Promise((resolve, reject) => {
            Api.filterTag(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    selectLocation({},data){
        return new Promise((resolve, reject) => {
            Api.filterLocation(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    searchListing({},data){
        return new Promise((resolve, reject) => {
            Api.searchListing(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    searchRequest({},data){
        return new Promise((resolve, reject) => {
            Api.searchRequest(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    filterRange({},data){
        console.log(data)
        return new Promise((resolve, reject) => {
            Api.filterRange(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    
    filterReqRange({},data){
        console.log(data)
        return new Promise((resolve, reject) => {
            Api.filterReqRange(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    selectRLocation({},data){
        return new Promise((resolve, reject) => {
            Api.filterRLocation(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    viewList({},data){
        return new Promise((resolve, reject) => {
            Api.viewList(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },


    uploadFile({dispatch},data){
        return new Promise((resolve, reject) => {
            let formdata=new FormData();
            formdata.append('file',data)
            formdata.append('field','profile')

            Api.uploadFile(formdata).then(res => {
                dispatch('getUser');
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },
    uploadVFile({dispatch},data){
        return new Promise((resolve, reject) => {
            let formdata=new FormData();
            formdata.append('file',data.file)
            formdata.append('field',data.field)
            Api.uploadVFile(formdata).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },

    verifyId({}, data) {
        return new Promise((resolve, reject) => {
            Api.verifyId(data).then(res => {
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },


    setCurrentPostion({ commit },data){

    console.log(data);
    
    },

    board({commit}){
     commit('setBoard')
    }


}