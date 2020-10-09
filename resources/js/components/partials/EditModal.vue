<template>
  <div class="contain" @click="closeEdit">
    <div class="c-list-con update" >
      <div class="c-list" v-if="list">
        <form v-on:submit.prevent ref="form">
          <div class="form-h">
            <h4>
                Listing Update
            </h4>
          </div>

          <div v-if="serverErrors">
            <div v-for="(error, index) in serverErrors" :key="index" class="alert alert-danger" role="alert">
              <strong><i class="fa fa-warning"></i> {{error[0]}}</strong>
            </div>
          </div>

          <div class="form-group">
            <label for="space_type">Space Type</label>
            <select 
             v-model="list.space_type"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option :value="list.space_type" selected disabled>{{list.space_type}}</option>
              <option value="apartment">Apartment</option>
              <option value="office">Office</option>
            </select>
          </div>

          <div class="form-group">
            <label for="space_for">Space for</label>
            <select 
            v-model="list.space_for"
            class="form-control" name="" id="space_for" placeholder="Space type">
              <option :value="list.space_for" selected disabled>{{list.space_for}}</option>
              <option value="rent">Rent</option>
              <option value="shear" v-if="list.space_type==='apartment'">Shear</option>
            </select>
          </div>

           <div class="form-group">
          <div class="col-sm-1-12">
            <div class="form-group">
              <label for="location">Location</label>
              <select class="form-control" id="location" v-model="list.space_location">
                <option selected :value="list.space_location" disabled>{{list.space_location}}</option>
                <option value="Lagos">Lagos</option>
                <option value="Ondo">Ondo</option>
                <option value="Oyo">Oyo</option>
              </select>
            </div>
          </div>
        </div>

          <div class="form-group">
            <label for>Space Address</label>
            <input
              placeholder="Space Address"
              class="form-control" 
              v-model="list.space_address"
            />
          </div>
          <div class="form-group">
            <label for>Rent</label>
            <input
            type="number"
              placeholder="Rent"
              class="form-control" 
              v-model="list.rent"
            />
          </div>

           <div class="form-group">
            <label for>Per (Month,Year)</label>
            <input
            type="text"
              placeholder="e.g, Month"
              class="form-control" 
              v-model.trim="list.duration"
            />
          </div>
          <div class="form-group">
            <label for>Available From</label>
            <input
              type="date"
              placeholder="Available Form"
              class="form-control" 
              v-model="list.available_from"
            />
        
          </div>
           <div class="form-group" v-if="list.space_type==='apartment'">
            <label for="space_type">Payer Type</label>
            <select 
            v-model="list.payer_gender"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option value="" selected disabled>Payer Gender</option>
              <option value="male">Male</option>
              <option value="female">Femle</option>
              <option value="others">Others</option>
            </select>
          </div>
         
          <div class="form-group" v-if="list.space_type==='apartment'">
            <label for>Bedroom Type</label>
            <input
              placeholder="E.g, Self contain,Three bed room flat"
              class="form-control" 
              v-model="list.bedroom_type"
            />
          </div>

          <div class="form-group">
            <label for>About Property</label>
            <textarea placeholder="About Property" 
            class="form-control"
            v-model="list.about_property"></textarea>
          </div>
          
          <div class="form-group" v-if="list.space_type==='apartment' && list.space_for!=='rent'">
            <label for>About Cohabitation</label>
            <textarea
              placeholder="About Cohabitation"
              class="form-control" 
              v-model="list.about_cohabitation"
            ></textarea>
          </div>

          <div class="edit-images">
            
             <div v-show="!uploadedUp" class="" v-for="(image, index) in list.images" :key="index">
                    <img :src="'/uploads/listing/'+ image" width="100px" height="100px"/>
            </div> 
          </div>

           <vue-dropzone 
           ref="myVueDropzone" 
           id="dropzone" 
           :options="dropzoneOptions" 
           @vdropzone-success-multiple="uploaded" 
            ></vue-dropzone>
            
          <button class="btn btn-primary btn-block" :disabled="loading" @click="updateList">
            <span v-if="loading"><i class="fa fa-spinner" aria-hidden="true"></i> </span>
              Update
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import UploadComponent from './../partials/UploadComponent';
import { TimelineLite } from "gsap/all";
import { required, minLength, email } from "vuelidate/lib/validators";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import {mapGetters} from 'vuex'
export default {
  props: ['id'],
  components: {
  Loading,
  UploadComponent,
  vueDropzone: vue2Dropzone
  },
  data() {
    return {
      value: true,
      loading: false,
      serverErrors: null,
      menu: false,
      uploadedUp:false,
      // 'http://localhost:8000/api/listing-file-upload',
      //http://proptybox.com.ng/api/listing-file-upload
      dropzoneOptions: {
          url:'http://proptybox.com.ng/api/listing-file-upload',
          thumbnailWidth: 100,
          thumbnailHeight: 100,
          maxFilesize: 0.5,
          method:'POST',
          addRemoveLinks: true,
          // parallelUploads: 10,
          
          acceptedFiles:'image/*',
          uploadMultiple:true,
          dictDefaultMessage:"<i class='fa fa-cloud-upload'>Drag files here or click to Upload</i>",
           headers: { "Authorization": "Bearer "+ localStorage.getItem('token')  },
           init: function() { 
            this.on("error", function(file, message) { 
                window.eventBus.$emit('fileError',message)
                this.removeFile(file); 
            });

        }
      },
    };
  },

  methods: {
    updateList() {
        this.loading = true;
        this.$store
          .dispatch("updateList", this.list)
          .then(() => {
            this.loading = false;
            this.$snotify.success("List Updated")
            window.eventBus.$emit('closeEdit');
            this.$router.push({ name: "my.listing" });
          })
          .catch(err => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong")
          this.serverErrors = Object.values(err.response.data.errors) ;
          window.scrollTo(0,0)
          });
    },
    uploaded(file,res){
        this.uploadedUp=true;
        this.list.images=res.files;

    },
    closeEdit(e){
      console.log(e.target.classList.contains('contain'));
      
       if (e.target.classList.contains('contain')){
      
            window.eventBus.$emit('closeEdit');
       }
    },
    getListId(){
          this.$store.dispatch('getListId',this.id)
      }
  },
  created () {
     $('html,body').animate({scrollTop:0},'600','swing');
    this.getListId();
      window.eventBus.$on('fileError',msg=>{
        this.$snotify.error(msg, {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true
            });
    })
  },
  mounted() {
    // let get=this.$ref.get
    let timeline = new TimelineLite();
    timeline.from(".c-list-con", { y: 50, opacity: 0 });
    timeline.from(".form-h", { x: -20, opacity: 0 });
  },

  computed: {
    
    ...mapGetters([
      'loggedIn',
      "list"
    ])
    
  
  }
};
</script>

<style lang="scss" scoped>
button{
  & span{
    padding-left: 5px;
    & i{
      animation:rot 1s infinite linear;
    transform-origin: center;
  }
  }
}
.edit-images{
      display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 10px;
    margin-bottom: 20px;

    img{
       padding:5px;
    }
}
@keyframes rot{
  100%{
    transform: rotate(360deg);

  }
}
.contain {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    z-index: 999;
    background: rgba(0, 0, 0, 0.5);
    padding-top: 80px;
  & .banner {
    height: 50px;
    background: #eef4ff;
  }

  & .c-list-con {
    // margin:10px;
    max-width: 500px;
    background: white;
    margin: 0px auto;
    transform: translateY(-50px);

    & .c-list {
      max-width: 400px;
      margin: 0px auto;
      padding: 10px;
      overflow-y: scroll;
      height: 90vh;

      &::-webkit-scrollbar{
        background:#eef4ff;
        width:5px;
      }

      &::-webkit-scrollbar-thumb{
        background:#3490dc;
        border-radius:2.5px
      }
      
      & .form-control {
        background: #eef4ff;
      }

      & .form-h {
        padding: 10px 10px 10px 0px;

        & span {
          color: #3490dc;
        }
      }
    }
  }
}


@media screen and (max-width:460px) {
 .contain {
  & .c-list-con {
    margin:10px !important;
    
  }
 }
}
</style>

<style lang="scss">

.banner {
    height: 50px;
    background: #eef4ff;
  }
  
</style>