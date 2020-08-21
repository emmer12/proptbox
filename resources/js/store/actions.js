import Api from './../api/api'

export default {

    registerUser({ commit,rootState }, data) {
        return new Promise((resolve, reject) => {
            Api.create(data).then(res => {
                let token = res.data.token;
                localStorage.setItem('token', token)
                commit("retrieveToken", {token,user:res.data.user,root:rootState})
                resolve(res)
            }).catch(err => {
                reject(err)

            })
        })
    },



    loginUser({commit}, data) {
        return new Promise((resolve, reject) => {
            Api.loginUser(data).then(res => {
                alert()
                let token = res.data.token;
                localStorage.setItem('token', token)
                commit("retrieveToken",token)
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
                    localStorage.removeItem('pinToken')
                    commit("destroyToken",rootState)
                    resolve(true)
                })
                .catch(err=>{
                    console.log(err);
                    
                })
        }
    },



}