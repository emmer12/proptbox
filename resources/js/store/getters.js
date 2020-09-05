export default {
    loggedIn(state){
        return state.token
    },

    user(state){
        return state.user;
    },

    listing(state){
        return state.listing.list
    },

    list(state){
        return state.listDetails
    },
    request(state){
        return state.requestDetails
    },
    hRequest(state){
        return state.hRequest
    },
    lTags(state){
        return state.listingTags
    },
    states(state){
        return state.states
    }
}