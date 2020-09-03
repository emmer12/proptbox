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
            <h4>{{user.firstname}} {{user.lastname}}</h4>
            <p>Male,31</p>
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

        <div class="verify">
          <h4>Verify Account</h4>

          <i class="fa fa-facebook active"></i>
          <i class="fa fa-twitter" aria-hidden="true"></i>
          <i class="fa fa-envelope active" aria-hidden="true"></i>
          <i class="fa fa-phone" aria-hidden="true"></i>
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

    & .verify {
    // background: #f6f6f6;
    padding: 10px;
    position: absolute;
    right:10px;
    bottom:10px;

    & h4{
        font-size:16px;
        padding:0px 20px;
    }

    & i {
      background: grey;
      padding: 10px;
      margin: 20px 10px;
      font-size: 25px;
      border-radius: 10px;
      color: white;
      &.active {
        background: #0d50bd;
      }
    }
  }
  }
}
</style>