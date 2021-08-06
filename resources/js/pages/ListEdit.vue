<template>
  <div class="contain">
    <div class="">
      <div class="" v-if="list">
        <form v-on:submit.prevent ref="form">
          <div class="form-h">
            <h4>Listing Edit</h4>
          </div>

          <div class="edit-tab">
            <div :class="{active:activeTab === 0}" @click="activeTab = 0">Edit</div>

            <div :class="{active:activeTab === 1}" @click="activeTab = 1">Add images</div>
          </div>

          <div v-if="serverErrors">
            <div
              v-for="(error, index) in serverErrors"
              :key="index"
              class="alert alert-danger"
              role="alert"
            >
              <strong><i class="fa fa-warning"></i> {{ error[0] }}</strong>
            </div>
          </div>

          <div v-if="activeTab === 0">

          <div class="form-group">
            <label for="space_type">Space Type</label>
            <select
              v-model="list.space_type"
              class="form-control"
              name=""
              id="space_type"
              placeholder="Space type"
            >
              <option :value="list.space_type" selected disabled>
                {{ list.space_type }}
              </option>
              <option value="apartment">Apartment</option>
              <option value="office">Office</option>
            </select>
          </div>

          <div class="form-group">
            <label for="space_for">Space for</label>
            <select
              v-model="list.space_for"
              class="form-control"
              name=""
              id="space_for"
              placeholder="Space type"
            >
              <option :value="list.space_for" selected disabled>
                {{ list.space_for }}
              </option>
              <option value="Rent">Rent</option>
              <option
                value="Space sharing"
                v-if="list.space_type === 'apartment'"
              >
                Space sharing
              </option>
            </select>
          </div>

          <div class="form-group">
            <div class="col-sm-1-12">
              <div class="form-group">
                <label for="location">Location</label>
                <select
                  class="form-control"
                  id="location"
                  v-model="list.space_location"
                >
                  <option selected :value="list.space_location" disabled>
                    {{ list.space_location }}
                  </option>
                  <option
                    :value="state.name"
                    v-for="(state, index) in states"
                    :key="index"
                  >
                    {{ state.name }}
                  </option>
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
          <div class="form-group" v-if="list.space_type === 'apartment'">
            <label for="space_type">Preferred Gender</label>
            <select
              v-model="list.payer_gender"
              class="form-control"
              name=""
              id="space_type"
              placeholder="Space type"
            >
              <option :value="list.payer_gender" selected disabled>
                Preferred Gender
              </option>
              <option value="Anyone welcome">Anyone welcome</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option
                v-if="list.space_for !== 'Space sharing'"
                value="Couple Only"
              >
                Couple only
              </option>
            </select>
          </div>

          <div class="form-group" v-if="list.space_type === 'apartment'">
            <label for>Bathroom Type</label>
            <select
              v-model="list.bedroom_type"
              class="form-control"
              name=""
              id="bedroom_type"
            >
              <option :value="list.bedroom_type" selected disabled>
                Bedroom type
              </option>
              <option value="Shared bathroom">Shared bathroom</option>
              <option value="Own bathroom ">Own bathroom</option>
              <option value="Ensuite">Ensuite</option>
            </select>
          </div>

          <div class="form-group" v-if="list.space_type === 'apartment'">
            <label for>Property Type</label>
            <select
              v-model="list.property_type"
              class="form-control"
              name=""
              id="bedroom_type"
            >
              <option :value="list.property_type" selected disabled>
                Property type
              </option>
              <option value="1 Bedroom">1 Bedroom</option>
              <option value="2 Bedroom">2 Bedroom</option>
              <option value="3 Bedroom">3 Bedroom</option>
              <option value="Self-Contained">Self contained</option>
            </select>
          </div>

          <div class="form-group">
            <label for>About Property</label>
            <textarea
              placeholder="About Property"
              class="form-control"
              v-model="list.about_property"
            ></textarea>
          </div>

          <div
            class="form-group"
            v-if="list.space_type === 'apartment' && list.space_for !== 'Rent'"
          >
            <label for>About Cohabitation</label>
            <textarea
              placeholder="About Cohabitation"
              class="form-control"
              v-model="list.about_cohabitation"
            ></textarea>
          </div>
          </div>

          <div v-if="activeTab === 1">
          <div class="edit-images">
            <div
              v-show="!uploadedUp"
              class=""
              v-for="(image, index) in list.images"
              :key="index"
            >
              <img
                :src="'/uploads/listing/' + image.filename"
                width="100px"
                height="100px"
              />
            </div>
          </div>

          <vue-dropzone
            ref="myVueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
            @vdropzone-success-multiple="uploaded"
          ></vue-dropzone>
          </div>

          <br>

          <button
            class="btn btn-primary btn-block"
            :disabled="loading"
            @click="updateList"
          >
            <span v-if="loading"
              ><i class="fa fa-spinner" aria-hidden="true"></i>
            </span>
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../components/FormLoading";
import UploadComponent from "../components/UploadComponent";
import { TimelineLite } from "gsap/all";
import { required, minLength, email } from "vuelidate/lib/validators";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { mapGetters } from "vuex";

let endpointProduction="https://proptybox.com/api/v1/listing-file-upload"
let endpointDev="http://localhost:8000/api/v1/listing-file-upload"

export default {
  components: {
    Loading,
    UploadComponent,
    vueDropzone: vue2Dropzone,
  },
  data() {
    return {
      value: true,
      loading: false,
      serverErrors: null,
      menu: false,
      uploadedUp: false,
      activeTab:0,
      dropzoneOptions: {
        url: endpointDev,
        thumbnailWidth: 100,
        thumbnailHeight: 100,
        maxFilesize: 20,
        method: "POST",
        addRemoveLinks: true,
        // parallelUploads: 10,

        acceptedFiles: "image/*",
        uploadMultiple: true,
        dictDefaultMessage:
          "<i class='fa fa-cloud-upload'>Drag files here or click to Upload</i>",
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
        init: function () {
          this.on("error", function (file, message) {
            window.eventBus.$emit("fileError", message);
            this.removeFile(file);
          });
           this.on("sending", function(file, xhr,formData) {
              formData.append("id",window.instance.list.id);
            })

        },
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
          this.$snotify.success("List Updated");
          this.getListId();
        })
        .catch((err) => {
          this.loading = false;
          this.$snotify.error("Opps, something went wrong");
          this.serverErrors = Object.values(err.response.data.errors);
          window.scrollTo(0, 0);
        });
    },
    uploaded(file, res) {
      this.uploadedUp = true;
      // this.list.images = res.files;
    },
    closeEdit(e) {
      if (e.target.classList.contains("contain")) {
        window.eventBus.$emit("closeEdit");
      }
    },
    getListId() {
      this.$store.dispatch("getListId", this.$route.params.id);
    },
    getState() {
      this.$store.dispatch("getState");
    },
    getState() {
      this.$store.dispatch("getState");
    },
  },
  created() {
    $("html,body").animate({ scrollTop: 0 }, "600", "swing");
    this.getListId();
    window.eventBus.$on("fileError", (msg) => {
      this.$snotify.error(msg, {
        timeout: 6000,
        showProgressBar: true,
        pauseOnHover: true,
      });
    });

     if (this.$route.params.creating) {
      this.activeTab=1
    }
  },
  mounted() {
    // let get=this.$ref.get
    window.instance=this;
    let timeline = new TimelineLite();
    timeline.from(".c-list-con", { y: 50, opacity: 0 });
    timeline.from(".form-h", { x: -20, opacity: 0 });
    this.getState();
    this.getListId();
  },

  computed: {
    ...mapGetters(["loggedIn", "list", "states"]),
  },
};
</script>

<style lang="scss" scoped>
button {
  & span {
    padding-left: 5px;
    & i {
      animation: rot 1s infinite linear;
      transform-origin: center;
    }
  }
}
.edit-images {
  display: flex;
  flex-wrap: wrap;
  padding: 10px;
  margin-bottom: 20px;

  img {
    padding: 5px;
  }
}
@keyframes rot {
  100% {
    transform: rotate(360deg);
  }
}
.contain {
  max-width: 600px;
  margin: 40px auto;
  padding-top: 80px;
  background: white;
  padding: 50px 20px;
  .banner {
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

      &::-webkit-scrollbar {
        background: #eef4ff;
        width: 5px;
      }

      &::-webkit-scrollbar-thumb {
        background: #3490dc;
        border-radius: 2.5px;
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

.edit-tab {
  display: flex;
  justify-content: space-around;
  flex-direction: row;
  width: 300px;

  div{
    width: 50%;
    text-align: center;
    font-size: 14px;
    text-transform: uppercase;
    margin: 10px 0px;
    padding: 10px;
    cursor: pointer;

    &:hover{
       color: #3490dc;
      border-bottom: 4px solid #3490dc;
    }
    
    &.active{
      color: #3490dc;
      border-bottom: 4px solid #3490dc;

    }
  }
}

@media screen and (max-width: 460px) {
  .contain {
    & .c-list-con {
      margin: 10px !important;
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