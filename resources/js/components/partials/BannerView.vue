<template>
  <div>
    <div class="banner-user" v-if="user">
      <div class="des-header2">
        <div class="display">
          <img
            :src="'/storage/uploads/images/'+user.profile_pic_filename"
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
                    <div class="v-icon">
                      <i class="fa fa-envelope active"></i>
                      <span class="fa fa-check"></span>
                    </div>
                    <div class="v-icon">
                        <i class="fa fa-user " aria-hidden="true"></i>
                        <span class="fa fa-check"></span>
                    </div>
                    <div class="v-icon">
                    <i class="fa fa-phone-square active" aria-hidden="true"></i>
                      <span class="fa fa-check "></span>
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
   .verify-con{
     position: absolute;
      right: 0px;
      bottom: 9px;
      background: transparent;
      padding: 5px;

    & h4{
      top: 29px;
      left: 18px;
      position: relative;
    }
   }
</style>