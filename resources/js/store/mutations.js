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
            loading(state,data){
                state.loading=data
            },

            destroyToken(state,rootState){
                state.token=null
                state.pinToken=null
                rootState.user.user=null

            },
            setUser(state,data){
                state.user=data;
            },
             setListing(state,list){
                state.listing.list=list.data;
                state.listing.links=list.links;
                state.listing.meta=list.meta;
            },
            destroyPinToken(state,rootState){
                state.pinToken=null
                rootState.user.user=null

            }
            

    }

    