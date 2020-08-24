export default {
    loggedIn(state){
        return state.token
    },

    user(state){
        return state.user;
    },

    listing(state){
        return state.listing.list
    }
}