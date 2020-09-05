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
              <option value="rent">Rent</option>
              <option value="shear" v-if="newList.space_type==='apartment'">Shear</option>
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
                <option selected value="" disabled>Select your Location</option>
                <option value="Lagos">Lagos</option>
                <option value="Ondo">Ondo</option>
                <option value="Oyo">Oyo</option>
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
            <label for="space_type">Payer Type</label>
            <select 
            v-model="newList.payer_gender"
            class="form-control" name="" id="space_type" placeholder="Space type">
              <option value="" selected disabled>Payer Gender</option>
              <option value="male">Male</option>
              <option value="female">Femle</option>
              <option value="others">Others</option>
            </select>
          </div>

           <div class="form-group">
            <label for>Tags</label>
             <tags-input element-id="tags"
              v-model="newList.selectedTags"
              :existing-tags="[
                  { key: 'self-contain', value: 'Self Contain' },
                  { key: 'two-bedroom', value: 'Two bedroom' },
                  { key: 'clean', value: 'Clean' },
              ]"
              :typeahead="true"></tags-input>
          </div>
         
          <div class="form-group" v-if="newList.space_type==='apartment'">
            <label for>Bedroom Type</label>
            <input
              placeholder="E.g, Self contain,Three bed room flat"
              class="form-control" 
              v-model="newList.bedroom_type"
            />
          </div>

          <div class="form-group">
            <label for>About Property</label>
            <textarea placeholder="About Property" 
            class="form-control"
            :class="{'is-invalid':$v.newList.about_property.$error}"
            v-model.trim="$v.newList.about_property.$model"></textarea>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.about_property.required"
            >This field is required</div>
          </div>
          
          <div class="form-group" v-if="newList.space_type==='apartment' && newList.space_for!=='rent'">
            <label for>About Cohabitation</label>
            <textarea
              placeholder="About Cohabitation"
              class="form-control" 
              v-model="newList.about_cohabitation"
            ></textarea>
          </div>

           <loading :loading="loading"></loading>
           <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
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
import { TimelineLite } from "gsap/all";
import { required, minLength, email } from "vuelidate/lib/validators";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  components: {
  Loading,
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
        space_for: "",
        space_type: "",
        payer_gender: "",
        space_location:'',
        selectedTags:[],
      },
      dropzoneOptions: {
          url: process.env.MIX_API_URL+'listing-file-upload',
          thumbnailWidth: 100,
          maxFilesize: 0.5,
          headers: { "My-Awesome-Header": "header value" }
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
          .then(() => {
            this.newList = {};
            this.loading = false;
            this.$snotify.success("List created")
            this.$router.push({ name: "my.listing" });
          })
          .catch(err => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong")
          this.serverErrors = Object.values(err.response.data.errors);
          window.scrollTo(0,0)
          });
      }
    }
  },
  mounted() {
    // let get=this.$ref.get
    let timeline = new TimelineLite();
    timeline.from(".c-list-con", { y: 50, opacity: 0 });
    timeline.from(".form-h", { x: -20, opacity: 0 });
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