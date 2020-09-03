<template>
  <div class="contain">
    <div class="banner"></div>
    <div class="c-list-con">
      <div class="c-list">
        <form ref="form" v-on:submit.prevent>
          <div class="form-h">
            <h4>
              <span>Request</span> for your space ?
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
              class="form-control"
              name
              id="space_type"
              placeholder="Space type"
            >
              <option value selected disabled>Space Type</option>
              <option value="apartment">Apartment</option>
              <option value="office">Office</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_type.required"
            >This field is required</div>
          </div>

          <div class="form-group">
            <label for="space_for">Space for</label>
            <select
              :class="{'is-invalid':$v.newList.space_for.$error}"
              v-model.trim="$v.newList.space_for.$model"
              class="form-control"
              name
              id="space_for"
              placeholder="Space type"
            >
              <option value selected disabled>Space For</option>
              <option value="rent">Rent</option>
              <option value="shear">Shear</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_for.required"
            >This field is required</div>
          </div>
          
           <div class="form-group">
            <label for>Space Location</label>
            <input
              :class="{'is-invalid':$v.newList.space_location.$error}"
              placeholder="e.g, Lagos,Abuja,Akure"
              class="form-control" 
              v-model.trim="$v.newList.space_location.$model"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newList.space_location.required"
            >space location is required</div>
          </div>

          <div class="form-group">
            <label for>Budget</label>
            <input type="number" 
            placeholder="Budget" 
            class="form-control"
            :class="{'is-invalid':$v.newList.budget.$error}"
              v-model.trim="$v.newList.budget.$model"
             />
              <div
              class="invalid-feedback"
              v-if="!$v.newList.budget.required"
            >This field is required</div>
          </div> 
          <div class="form-group">
            <label for>About Property</label>
            <textarea v-model="newList.about_property" placeholder="Specify the type and what you look forward to" class="form-control"></textarea>
          </div>
         
        
           <loading :loading="loading"></loading>
          
          <button class="btn btn-primary btn-block" :disabled="loading" @click="makeRequest">
            <span v-if="loading"><i class="fa fa-spinner" aria-hidden="true"></i> </span>
             Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";
import Loading from './../partials/FormLoading';
import { TimelineLite } from "gsap/all";
export default {
     components: {
  Loading
  },
  data() {
    return {
      value: true,
      newList: {
        about_property: "",
        budget: "",
        space_for: "",
        space_type: "",
        space_location:""
      },
      loading: false,
      serverErrors: null,
      menu: false
    };
  },

  validations: {
    newList: {
    //   about_property: { required },
      budget: { required },
      space_type: { required },
      space_for: { required },
      space_location:{required}
    }
  },
  methods: {
     makeRequest() {
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
          .dispatch("sendRequest", this.newList)
          .then(() => {
            this.newList = {};
            this.loading = false;
            alert()
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
</style>