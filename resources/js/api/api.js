import Api from './index'


 const registerUser=()=>{
    alert()
}


 const loginUser=(data)=>{
    return Api.post('/login',data)
}
export default {
    registerUser,
    loginUser
}