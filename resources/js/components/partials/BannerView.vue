<template>
  <div>
    <div class="banner-user" v-if="user">
      <div class="des-header2">
        <div class="display">
          <img
            :src="'/uploads/profile-images/'+user.profile_pic_filename"
            width="180px"
            height="180px"
          />
        </div>
        <div class="c-t-a">
          <div class="details">
            <h4>{{user.fullname}}</h4>
            <p>{{ user.gender}}, {{ user.age}}</p>
          </div>
        </div>

        <div class="action">
          <router-link
            v-if="from==='list'"
            :to="{name:'new-list'}"
            tag="button"
            class="btn btn-primary"
          >
            <i class="fa fa-plus" aria-hidden="true"></i>
          </router-link>
          <router-link
            v-if="from==='request' "
            :to="{name:'new-request'}"
            tag="button"
            class="btn btn-primary"
          >
            <i class="fa fa-plus" aria-hidden="true"></i>
          </router-link>
        </div>

      <div class="verify-con">
                <h4>Verify Account</h4>
                <div class="verify">
                  <div class="v-icon" @click="verify('email')">
                    <i class="fa fa-envelope" :class="{active:user.email_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.email_verified_at"></span>
                  </div>
                  <div class="v-icon" @click="verify('id')" >
                    <i class="fa fa-user" aria-hidden="true" :class="{active:user.id_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.id_verified_at"></span>
                  </div>
                  <div class="v-icon" @click="verify('phone')">
                    <i class="fa fa-phone-square" aria-hidden="true" :class="{active:user.phone_verified_at}"></i>
                    <span class="fa fa-check" v-if="user.phone_verified_at"></span>
                  </div>
                </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["from"],
  methods: {},
  computed: {
    ...mapGetters(["user"])
  }
};
</script>

<style lang="scss" scoped>
.banner-user {
  position: relative;
  & .des-header2 {
    background: white;
    display: flex;
    padding: 20px;
    margin-bottom: 10px;
    border-bottom: 8px solid #3490dc;
    & .display {
      & img {
        border-radius: 50%;
      }
    }

    & .c-t-a {
      padding-left: 20px;
      position: relative;
      padding-top: 70px;
      line-height: 20px;
    }

    & .action {
      position: absolute;
      right: 10px;
      top: 10px;
    }
  }
}
  
   @media (max-width:460px) {
    .banner-user{
    
    & .des-header2 {
      display:block;
      text-align:center;
      & .display {
        & img {
          width:100px;
          height:100px;
          border-radius: 50%;
        }
      }
      & .c-t-a {
          padding-left: 20px;
        padding-top: 15px;
        line-height: 12px;
      }
    }
   }
   }
</style>