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

const getUser=()=>{
    return Api.get('auth-user');
}

const getListSlug=(slug)=>{
    return Api.get('get-list-by-slug/'+slug);
}

const createList=(data)=>{
    return Api.post('/create-listing',data)
}

const deleteList=(data)=>{
    return Api.delete('/delete-listing/'+data)
}

const sendRequest=(data)=>{
    return Api.post('/send-request',data)
}
const socialSignUp=(provider)=>{
    return Api.get('/sign-in/'+provider);
}

const loginUpSocial=(payload,provider)=>{
    return Api.get('/sign-in/'+provider+'/redirect', {
        params: payload
    })
}
const setupOther=(data)=>{
    return Api.post('/other-setup',data)
}
const setupOtherSign=(data)=>{
    return Api.post('/other-setup-signup',data)
}
const resetPasswordRequest=(data)=>{
    return Api.post('/request-password-reset',data)
}

const resetPassword=(data)=>{
    return Api.post('/reset-password',data)
}

const getRequestLimit=(state)=>{
    let url = state.token ? '/all-request-by-location' : '/all-request-limit'
    return Api.get(url)
}

export default {
    registerUser,
    loginUser,
    verifyEmail,
    getUser,
    getListing,
    getListSlug,
    createList,
    deleteList,
    socialSignUp,
    loginUpSocial,
    setupOther,
    setupOtherSign,
    sendRequest,
    resetPasswordRequest,
    resetPassword,
    getRequestLimit
}