<template>
  <div>
      <div class="list-boost">
        <span @click="closeAd" >
            <i class="fa fa-times-circle" aria-hidden="true"></i>
        </span>
        <router-link @click="closeAd" tag="div" class="img"  :to="{name:'boost',params:{id:list.id}}">
         <h1>Boost now to get your listing bumped up to the top daily</h1>
         <img :src="'/uploads/listing/'+list.images[0]" width="100%"/>
          <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {{list.space_location }}</div>
       </router-link>

        <div class="details">
            <div class="title">
            <h4>{{ list.space_type }}</h4>
            </div>
            <div class="l-p">
                <h4 v-if="list.space_address.length>20">{{list.space_address.substr(0,20) + '...' }}</h4>
                <h4 v-else>{{list.space_address}}</h4>
            <h5>&#8358;{{list.rent}}</h5>
            </div>
            <hr>
           <router-link  @click="closeAd" :to="{name:'boost',params:{id:list.id}}" tag="button" class="btn btn-outline-primary pull-right">Boost</router-link>

        </div>

       
  </div>

  <div class="overlay"  @click="closeAd"></div>
  </div>
</template>

<script>
export default {
    props:['list'],
    data() {
        return {
            // list:{
            //     id:1,
            //     image:'listing-1601117273-sl3.jpg',
            //     space_type:'Apartment',
            //     space_address:"this is the address of the space",
            //     about_property:'this is about property',
            //     space_location:"Ondo",
            //     rent:2000
                
            // }
        }
    },
    methods: {
        closeAd(){
            window.eventBus.$emit('closeAd')
            
        }
    }
}
</script>

<style lang="scss" scoped >
  .overlay{
      position:fixed;
      top:0;
      left:0;
      height:100%;
      width:100%;
      background:rgba(0,0,0,0.7);
      z-index:9998
  }
  .list-boost{
      max-width:600px;
    //   height:400px;
      color:white;
      background:#222;
      z-index: 9999;
      padding:10px;
      position:fixed;
      top:40%;
      left:50%;
      transform:translate(-50%,-50%);

      img{
          max-height:255px;
          object-fit:cover;
      }

      .title{
          h4{
              color:#5b9fdc;
              font-size:inherit;
          }
      }
      h1{
          padding: 15px 0px;
    font-size: 1.8rem;
    color: white;
    font-weight: 700;
      }

      h4{
          font-size:16px
      }

      span{
          float:right;
          font-size:20px;
      }
  }

  @media (max-width:600px){
  .list-boost{
      width: 80%;
  }
  }
</style>