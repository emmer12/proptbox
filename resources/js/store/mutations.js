    export default {
            getCategory(state,data){
                state.category=data;
            },

            deletePost(state,data){
                data.map(id=>{
                    let index=state.userPosts.findIndex(item=>item._id == id)
                    state.userPosts.splice(index,1)
                })
            },

            retrieveToken(state,token){
                state.token=token
            
            },
            setListId(state,data){
                state.listDetails=data
            },
            setRequestById(state,data){
                state.requestDetails=data
            },
                destroyToken(state,rootState){
                state.token=null
                state.pinToken=null
                rootState.user.user=null

            },
            setUser(state,data){
                state.user=data;
            },
            setStates(state,data){
                state.states=data
            },
             setListing(state,list){
                state.listing.links=list.links;
                state.listing.meta=list.meta;
            },
            setTags(state,data){
                state.listingTags=data;
            },
            destroyPinToken(state,rootState){
                state.pinToken=null
                rootState.user.user=null

            },
            setHRequest(state,data){
                state.hRequest=data
            }
            

    }

    