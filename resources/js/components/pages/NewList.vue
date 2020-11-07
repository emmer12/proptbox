<template>
  <div class="contain">
    <div class="banner"></div>
    <div class="c-list-con">
      <div class="c-list">
        <form v-on:submit.prevent ref="form">
          <div class="form-h">
            <h4>
              <span>List</span> your space ?
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
            :class="{'is-invalid':$v.newList.space_type.$error}"
            v-model.trim="$v.newList.space_type.$model"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option value="" selected disabled>Space Type</option>
              <option value="apartment">Apartment</option>
              <option value="office">Office</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_type.required"
            >Type of apartment is required</div>
          </div>

          <div class="form-group">
            <label for="space_for">Space for</label>
            <select 
            :class="{'is-invalid':$v.newList.space_for.$error}"
            v-model.trim="$v.newList.space_for.$model"
            class="form-control" name="" id="space_for" placeholder="Space type">
              <option value="" selected disabled>Space For</option>
              <option value="Rent">Rent</option>
              <option value="Space sharing" v-if="newList.space_type==='apartment'">Space sharing</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_for.required"
            >This field is required</div>
          </div>

           <div class="form-group">
          <div class="col-sm-1-12">
            <div class="form-group">
              <label for="location">Location</label>
              <select class="form-control"  :class="{'is-invalid':$v.newList.space_location.$error}" id="location" v-model.trim="$v.newList.space_location.$model">
                <option selected value="" disabled>Select Listing Location</option>
                <option :value="state.name" v-for="(state, index) in states" :key="index">{{state.name}}</option>
              </select>
            </div>
            <div class="invalid-feedback" v-if="!$v.newList.space_location.required">This field is required</div>
          </div>
        </div>

          <div class="form-group">
            <label for>Space Address</label>
            <input
              :class="{'is-invalid':$v.newList.space_address.$error}"
              placeholder="Space Address"
              class="form-control" 
              v-model.trim="$v.newList.space_address.$model"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_address.required"
            >Space address is required</div>
          </div>
          <div class="form-group">
            <label for>Rent</label>
            <input
            type="number"
              :class="{'is-invalid':$v.newList.rent.$error}"
              placeholder="Rent"
              class="form-control" 
              v-model.trim="$v.newList.rent.$model"
            />
            <div class="invalid-feedback" v-if="!$v.newList.rent.required">This field is required</div>
          </div>

           <div class="form-group">
            <label for>Per (Month,Year)</label>
            <input
            type="text"
              :class="{'is-invalid':$v.newList.duration.$error}"
              placeholder="e.g, Month"
              class="form-control" 
              v-model.trim="$v.newList.duration.$model"
            />
            <div class="invalid-feedback" v-if="!$v.newList.duration.required">This field is required</div>
          </div>
          <div class="form-group">
            <label for>Available From</label>
            <input
              type="date"
              :class="{'is-invalid':$v.newList.available_from.$error}"
              placeholder="Available Form"
              class="form-control" 
              v-model.trim="$v.newList.available_from.$model"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newList.available_from.required"
            >Available from is required</div>
          </div>
           <div class="form-group" v-if="newList.space_type==='apartment'">
            <label for="space_type">Preferred Gender</label>
            <select 
            v-model="newList.payer_gender"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option value="" selected disabled>Preferred Gender</option>
              <option value="Anyone welcome">Anyone welcome</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option v-if="newList.space_for!=='Space sharing'" value="Couple Only">Couple only</option>
            </select>
          </div>

           <div class="form-group">
            <label for>Tags</label>
             <tags-input element-id="tags"
              v-model="newList.selectedTags"
              :existing-tags="[
                  { key: 'ensuite', value: 'Ensuite' },
                  { key: 'apartment', value: 'Apartment' },
                  { key: 'rent', value: 'Rent' },
                  { key: 'cohab', value: 'Cohab' },
                  { key: 'space shareing', value: 'Space sharing' },
                  { key: 'self-contain', value: 'Self contained' },
                  { key: '1-bedroom-flat', value: '1 Bedroom flat' },
                  { key: '2-bedroom-flat', value: '2 Bedroom flat' },
                  { key: '3-bedroom-flat', value: '3 Bedroom flat' },
              ]"
              :typeahead="true"></tags-input>
          </div>
         
          <div class="form-group" v-if="newList.space_type==='apartment'">
            <label for>Bathroom Type</label>
              <select 
            v-model="newList.bedroom_type"
            class="form-control" name="" id="bedroom_type" >
              <option value="" selected disabled>Bedroom type</option>
              <option value="Shared bathroom">Shared bathroom</option>
              <option value="Own bathroom ">Own bathroom</option>
              <option value="Ensuite">Ensuite</option>
            </select>
          </div>

           
          <div class="form-group" v-if="newList.space_type==='apartment' && !otherMode">
            <label for>Property Type</label>
              <select 
            v-model="newList.property_type"
            class="form-control" name="" id="bedroom_type" @change="(val)=>checkOtherMode(val)">
              <option value="" selected disabled>Property type</option>
              <option value="1 Bedroom">1 Bedroom</option>
              <option value="2 Bedroom">2 Bedroom</option>
              <option value="3 Bedroom">3 Bedroom</option>
              <option value="Self-Contained">Self contained</option>
              <option value="others">Others---please specify</option>

            </select>
          </div>
          <div class="form-group" v-show="otherMode">
            <label for>Property type</label>
            <input v-model="property_other"  v-on:blur="changeType" class="form-control" placeholder="Please specify property type" />
            </div>
          <div class="form-group">
            <label for>About Property</label>
            <small><i class="fa fa-question-circle" aria-hidden="true"></i> Tell us what's "wow" about the property and the area</small>
            <textarea placeholder="About Property" 
            class="form-control"
            :class="{'is-invalid':$v.newList.about_property.$error}"
            v-model.trim="$v.newList.about_property.$model"></textarea>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.about_property.required"
            >This field is required</div>
          </div>
          
          <div class="form-group" v-if="newList.space_type==='apartment' && newList.space_for!=='Rent'">
            <label for>About Cohabitant</label>
            <small><i class="fa fa-question-circle" aria-hidden="true"></i> Share a bit about yourself (personality) and what you're looking out for in your cohabitant(s) </small>
            <textarea
              placeholder="About Cohabitant"
              class="form-control" 
              v-model="newList.about_cohabitation"
            ></textarea>
          </div>


           <loading :loading="loading"></loading>
           <!-- <upload-component></upload-component> -->
           <div>
             <label >Upload your display picture</label>
              <vue-dropzone 
           ref="myVueDropzone" 
           id="dropzone" 
           :options="dropzoneOptions" 
           @vdropzone-success-multiple="uploaded" 
           @vdropzone-error="error"
            ></vue-dropzone>
           </div>
           <br/>

          
          <button class="btn btn-primary btn-block" :disabled="loading" @click="createList">
            <span v-if="loading"><i class="fa fa-spinner" aria-hidden="true"></i> </span>
             Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from './../partials/FormLoading';
import UploadComponent from './../partials/UploadComponent';
import { gsap } from "gsap";
import { required, minLength, email } from "vuelidate/lib/validators";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import {mapGetters} from 'vuex'
export default {
  components: {
  Loading,
  UploadComponent,
  vueDropzone: vue2Dropzone
  },
  data() {
    return {
      value: true,
      newList: {
        about_cohabitation: "",
        about_property: "",
        available_from: "",
        bedroom_type: "",
        rent: "",
        duration: "",
        space_address: "",
        property_type: "",
        space_for: "",
        space_type: "",
        payer_gender: "",
        space_location:'',
        selectedTags:[],
        images:'',
      },
      otherMode:false,
      property_other:"",
      // 'http://localhost:8000/api/v1/listing-file-upload',
      //https://proptybox.com.ng/api/v1/listing-file-upload
      // 'https://proptybox.com/api/v1/listing-file-upload'
      dropzoneOptions: {
          url:'https://proptybox.com/api/v1/listing-file-upload',
          thumbnailWidth: 100,
          thumbnailHeight: 100,
          maxFilesize: 20,
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
      loading: false,
      serverErrors: null,
      menu: false
    };
  },

  validations: {
    newList: {
      //  about_cohabitation: { required },
      available_from: { required },
      about_property: { required },
      space_location: { required },
        // bedroom_type: { required },
      rent: { required },
      duration:{ required },
      space_address: { required },
      space_type: { required },
      space_for: { required },
        // payer_gender: { required }
    }
  },

  methods: {
    createList() {
      this.$v.$touch();
      this.$refs.form.classList.remove("shake");
      if (this.$v.$invalid) {
        let tis = this;
        setTimeout(function() {
          tis.$refs.form.classList.add("shake");
        }, 1000);
      } else {
        this.loading = true;
        this.$store
          .dispatch("createList", this.newList)
          .then((res) => {
            this.newList = {};
            this.loading = false;
            this.$snotify.success("List created")
            this.$router.push({ name: "home" });
            console.log(res)
            window.eventBus.$emit('showAds',res.data.list)
          })
          .catch(err => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong")
          this.serverErrors = Object.values(err.response.data.errors);
          window.scrollTo(0,0)
          });
      }
    },
    uploaded(file,res){
      if (this.newList.images.length) {
        let prev=this.newList.images;
        let next=res.files;
        let open=prev.substr(0,prev.length-1);
        let close=','.concat(next.substr(1));
        this.newList.images=open.concat(close);

        this.$snotify.success("file uploaded")
      }else{
        this.newList.images=res.files
      }
    },
    error(file){
      // console.log(file);
      // let msg=`${file.upload.filename}, 'Upload error' + ${file.status}`
      // this.$snotify.error("Opps,"+msg)
    },
    getState(){
      this.$store.dispatch('getState');
    },
    checkOtherMode(e){
      if (e.target.value=='others') {
        this.otherMode=true
      }
    },
    changeType(){
      this.newList.property_type=this.property_other;

    }
  },
  mounted() {
    // let get=this.$ref.get
    // let timeline = new TimelineLite();
    gsap.from(".c-list-con", { y: 50, opacity: 0 });
    gsap.from(".form-h", { x: -20, opacity: 0 });
  },
  created(){
    this.getState();
    window.eventBus.$on('fileError',msg=>{
        this.$snotify.error(msg, {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true
            });
    });
  },

  computed: {
    ...mapGetters([
      'loggedIn',
      'states'
    ])
  }
};
</script>

<style lang="scss">
button{
  & span{
    padding-left: 5px;
    & i{
      animation:rot 1s infinite linear;
    transform-origin: center;
  }
  }
}
@keyframes rot{
  100%{
    transform: rotate(360deg);

  }
}
.contain {
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

      small{
          display: block;
          padding: 7px 0px;
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