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
                state.user=null 
                state.onBoarding=true
                localStorage.removeItem('board')

            },
            setUser(state,data){
                state.user=data;
                localStorage.setItem('user',JSON.stringify(data));
            },
            setFUser(state,data){
                state.profile=data;
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
            },

            setChats(state,data){
                state.chat.chats=data
            },
            setActive(state,data){
                let activeChat=state.chat.chats.find(chat=>chat.id===data);
                
                state.chat.activeChat=activeChat
                state.chat.messages=activeChat.msg
            },
            clearActive(state){
                state.chat.activeChat=null
            },
            setBoard(state){
                state.onBoarding=false;
                localStorage.setItem('board',true)
            }

    }

    