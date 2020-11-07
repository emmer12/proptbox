<template>
  <div class="signup-con">
    <div class="header">
      <h4>Identity Verification</h4>
    </div>
    <div class="container">
      <form v-on:submit.prevent ref="form" :class="{shake:invalid}">
        <div class="alert alert-danger" v-if="serverErrors" role="alert">
          <strong>{{serverErrors}}</strong>
        </div>

        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Card Holder Name</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.name.$error}"
              name="inputName"
              v-model.trim="$v.newUser.name.$model"
              id="inputName"
              placeholder="Name"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.name.required">This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Nationality</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.nationality.$error}"
              name="inputName"
              v-model.trim="$v.newUser.nationality.$model"
              id="inputName"
              placeholder="Nationality"
            />
            <div
              class="invalid-feedback"
              v-if="!$v.newUser.nationality.required"
            >This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Organization/School/Others</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.oso.$error}"
              name="inputName"
              v-model.trim="$v.newUser.oso.$model"
              id="inputName"
              placeholder='Organization'
            />
            <div class="invalid-feedback" v-if="!$v.newUser.oso.required">This field is required</div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputName" class="col-sm-1-12 col-form-label">Id Card Type</label>
          <div class="col-sm-1-12">
            <input
              type="text"
              class="form-control"
              :class="{'is-invalid':$v.newUser.id_type.$error}"
              name="inputName"
              v-model.trim="$v.newUser.id_type.$model"
              id="inputName"
              placeholder="Identification Type"
            />
            <div class="invalid-feedback" v-if="!$v.newUser.id_type.required">This field is required</div>
          </div>
        </div>

        <div class="row">
         
          <div class="col">
            <div class="form-group">
              <label v-if="newUser.front" for="front"> <img height="100px" width="100px" :src="'/uploads/ids/'+newUser.front" /></label>
              <label v-else for="front" class=" col-upload-label">Front</label>
              <div class="">
                <input type="file" id="front" style="display:none" @change="(e)=>processFormImg(e,'front')" />
                <div class="invalid-feedback"></div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label v-if="newUser.back" for="back"> <img  height="100px" width="100px" :src="'/uploads/ids/'+newUser.back" /></label>
              <label v-else for="back" class=" col-upload-label">Back</label>
              <div class="">
               
                <input type="file" id="back" style="display:none" @change="(e)=>processFormImg(e,'back')" />
                <div class="invalid-feedback"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class>
            <button
              type="submit"
              class="btn btn-primary btn-block"
              :disabled="loading"
              @click="submit"
            >Submit</button>
          </div>
        </div>

        <loading :loading="loading"></loading>
      </form>
    </div>
    <div style="height:300px"></div>
  </div>
</template>

<script>
import Loading from "./../partials/FormLoading";
import { required, minLength, email } from "vuelidate/lib/validators";
export default {
  components: {
    Loading
  },
  data() {
    return {
      value: true,
      invalid: false,
      newUser: {
        name:"",
        nationality: "",
        oso: "",
        id_type:"",
        front:'',
        back:''
      },
      serverErrors: false,
      loading: false,
      imgLoading:false,
      fileSeleted:null,
    };
  },
  validations: {
    newUser: {
      name: {
        required,
      },
    nationality: {
        required
      },
     oso:{
       required
     },
     id_type:{
       required
     }
    }
  },
  methods: {
      processFormImg(e,field) {
      this.fileSeleted = e.target.files[0];
      
      this.uploadImage(field);
    },
    uploadImage(field) {
      this.imgLoading = true;
      this.$store
      .dispatch("uploadVFile", {file:this.fileSeleted,field})
        .then(res => {
          if (res.data.field==='front') {
            this.newUser.front=res.data.filename
          }else{
            this.newUser.back=res.data.filename
            
          }
          this.imgLoading = false;
        })
        .catch(err => {
          this.serverErrors = err.response.data.msg;
          this.imgLoading = false;
        });
    },
    submit() {
      this.$v.$touch();
      this.$refs.form.classList.remove("shake");
      if (this.$v.$invalid) {
        // this.invalid=true;
        let tis = this;
        setTimeout(function() {
          tis.$refs.form.classList.add("shake");
        }, 1000);
      } else {
        this.valid = false;
        this.loading = true;
        this.$store
          .dispatch("verifyId", this.newUser)
          .then(() => {
            this.loading = false;
            this.$snotify.success("Identification verification request sent", {
              timeout: 6000,
              showProgressBar: true,
              pauseOnHover: true
            });
            this.$router.push({ name: "account-set" });
          })
          .catch(err => {
            this.loading = false;
            this.$snotify.error(this.$snotify.error(err.response.data.errors ?  Object.values(err.response.data.errors)[0][0] : "Opps, something went wrong please try again"));
            this.serverErrors = err.response
              ? err.response.data.msg
              : "invalid cridential";
          });
      }
    }
  },
 
};
</script>



<style lang="scss" scoped>
.signup-con {
    max-width: 400px;
    margin: 0px auto;
    background: white;
    padding: 10px;
    position: relative;
    transform: translateY(-54px);
    z-index: 999;
  & .header {
    text-align: center;
    & h4 {
      background: #eef4ff;
    }
  }
}
</style>

<style lang="scss" scoped>

.col-upload-label{
    background: #e1e8ef;
    border: 1px dashed #cac4c4;
    cursor: pointer;
    height: 100px;
    width: 100px;
    text-align: center;
    line-height: 100px;
}
.loading-overlay {
  top: 0px;
  left: 0px;
  position: absolute;
  height: 100%;
  width: 100%;
  background: rgba(254, 255, 255, 0.7);
  text-align: center;
  line-height: 150px;
  transition: 0.5s;
}
#path {
  stroke-dasharray: 50;
  stroke: white;
  animation: dash 5s linear infinite;
  stroke-width: 30px;
  opacity: 0.8;
  fill: #3490dc;
}

.shake {
  animation: shake 1s;
}
.f-password {
  & span {
    float: right;
    padding: 10px 0px;
  }
}

@keyframes dash {
  to {
    stroke-dashoffset: 1000;
    fill: #3490dc;
  }
}


@media (max-width:460px){
  .signup-con {
    transform: translateY(0px);
    margin:10px;
}
}
</style>

<style lang="scss" >
.c-btn {
  display: block;
  padding: 10px;
  background: #eef4ff;
  text-align: center;
  border-radius: 5px;
  margin: 5px 0px;
  cursor: pointer;
  transition: 0.3s;
  &:hover {
    background: #3490dc;
    color: white;
    font-weight: 700;
  }
}
</style>