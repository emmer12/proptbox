<template>
  <div style="">
      <div v-if="!lists.length">
        <div class="container">
          <div class="alert alert-default" style="border-left:4px solid #3490dc" role="alert">
          <h4 class="alert-heading">Empty List:</h4>
          <router-link  class="btn btn-primary" tag="button" :to="{name:'new-list'}">Create New <i class="fa fa-plus" aria-hidden="true"></i></router-link>
        </div>
        </div>
      </div>
      <div v-else class="row">
        <div class="col-md-4 col-sm-12" v-for="(list, index) in lists" :key="index">
            <div class="card p-card">
              <div class="user-action" v-show="user && user.id==list.user.id"> 
                  <!-- <div class="btn btn" @click="deleteList(list.id)">
                      
                  </div> -->
                  <ul class="drop" :id="'drop'+list.id">
                     <router-link to="#" tag="li">Edit</router-link>
                     <router-link to="#" tag="li">Boost</router-link>
                     <li>Delete</li>
                  </ul>
                  <div class='btn' >
                    <i class="fa fa-ellipsis-v" @click="showDrop" :data-id="list.id"  aria-hidden="true"></i>
                  </div>
              </div>
              <router-link :to="{name:'list-details',params:{slug:list.slug}}" tag="div" class="img">
                <img :src="'/images/'+ 1 +'.jpg'" width="100%"/>
              </router-link>

              <div class="details">
                  <div class="title">
                    <h4>{{ list.space_type }}</h4>
                    <button v-if="index%2==0" class="btn btn-danger btn-sm">For rent</button>
                    <button v-else class="btn btn-primary btn-sm">For sale</button>
                  </div>
                  <div class="l-p">
                    <h4> {{list.space_address}}</h4>
                    <h5>${{list.rent}}</h5>
                  </div>
                  <div class="description">
                    <!-- <h4>title of des</h4> -->
                    <p>{{list.about_property}}</p>
                  </div>
                  <hr>
                  <div class="c-t-a">
                      <span class="mr-2"><i class="fa fa-eye"></i> 23+</span>
                  </div>
              </div>
            </div>
         </div>
      </div>

     
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  props: ['lists'],
  data () {
    return {
      drop:false  
    }
  },
  methods: {
    deleteList(id){
      let conf=confirm("Are you sure you want to delete this list?")
      if (conf) {
        this.$store.dispatch('deleteList',id).then(()=>{
          this.$snotify.success("Listing deleted")
        })
      }else{
        return
      }
    },
    showDrop(e){
    let id=e.target.getAttribute('data-id');
    let els=document.getElementById("drop"+id)
      // els.classList.remove('added')

    // if (el.classList.contains('added')) {
    //   el.classList.remove('added')
    // }else{
    //   el.classList.add('added')
    // }
    
    els.classList.toggle('added')

    // setTimeout(function(){
    //    document.querySelectorAll('ul').forEach(el=>{
    //    el.classList.remove('added')
    // })
    // },1000)
    }
  },
  computed: {
    ...mapGetters([
      'user'
    ])
  }
}
</script>

<style lang="scss" scoped>
 .p-card{
   padding:10px;
   margin-bottom:20px;
   & .user-action{
     position:absolute;
     right:0px;
     padding:10px;
     display:flex;
     & div{
       margin:0px 10px;
       & i{
         color:white;
         font-size:30px;
       }
     }
     & ul.drop{
       margin:10px;
       padding:10px;
       position:absolute;
       right:10px;
       background:white;
       top:33px;
       display:none;
       opacity:0;
       transition:0.3s;
       &.added{
         display:block;
         opacity:1;
       }
       & li{
         display:block;
         padding:5px 20px;
         margin:3px;
         cursor:pointer;

         &:hover{
           background:#eef4ee
         }

       }
     }
   }
   & .img img{
     border-radius:5px;
   }
   & .details{
     border:1px solid #f6f6f6;
     border-radius: 3px;
     margin-top:10px;
     padding:5px;
     & .title{
       position:relative;
       & button{
         right:5px;
         top:0px;
         position:absolute
       }
       & h4{
          font-size: 22px !important;
       }
     }   
     & .l-p{
         display: flex;
         justify-content: space-between;
         align-items:center;
        //  padding: 5px 10px;

         & h4{
           color:#222;
           font-size:16px;
          //  font-weight: bolder;
         }
     }


     & .l-p{
       padding-top:10px;
       & h4{
           color:rgba($color: #000000, $alpha: 0.8);
           font-size:18px;
          // margin-left:-5px
         }
        & h5{
          font-size: 14px;
        }
      }

    & .description{
        & h4{
          color:#444;
          font-size: 18px;
          // font-weight: bolder;
        }
    }

    & .c-t-a{
      display: flex;
      justify-content: flex-end;
      & span{
        color:grey;
        font-size: 12px;
        & i{
        font-size:20px;
        margin:0px 10px;

        }
      }
    }
     
   }
 }
</style>

<style lang="scss">
.anim{
  padding:10px 20px;
  background:#fff;
  width:130px;
  font-size: 20px;
  position:relative;
  overflow: hidden;
  margin:50px;
  color: #5895f9;
  box-sizing: border-box;

  &::after{
    content: "";
    height:100%;
    width:50%;
    background:rgba($color: #ffffff, $alpha:0.8);
    position:absolute;
    top:0px;
    left: 0px;
    animation:load 0.5s infinite alternate
    
  }

  @keyframes load {
    from{
      transform: translateX(0%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
      border-left: 2px solid #5895f9; 
    }
    to{
      transform: translateX(100%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
    }
  }


}
</style>