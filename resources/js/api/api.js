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

const getListing=(state)=>{
    let url = state.token ? 'all-listing-by-location' : 'all-listing'
    return Api.get(url)
}

const getUser=(data)=>{
    return Api.get('auth-user');
}


export default {
    registerUser,
    loginUser,
    verifyEmail,
    getUser,
    getListing
}