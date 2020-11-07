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
    },
    profile(state){
        return state.profile
    },
    onBoarding(state){
        return state.onBoarding
    },
    chats(state){
        return state.chat.chats
    },
    activeChat(state){
        return state.chat.activeChat
    },
    messages(state){
        return state.chat.messages
    }
}