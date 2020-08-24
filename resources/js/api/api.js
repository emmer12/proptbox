import Api from './index'


 const registerUser=(data)=>{
    return Api.post('/register',data)
}


 const loginUser=(data)=>{
    return Api.post('/login',data)
}

const verifyEmail=(data)=>{
    return Api.get('email-verification?id='+data.id+'&hash='+data.hash)
}

export default {
    registerUser,
    loginUser,
    verifyEmail
}