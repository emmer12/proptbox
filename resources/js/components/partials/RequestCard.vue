<template>
  <div>

          <router-link tag="div" :to="{name:'request-details',params:{id:request.id}}" class="card r-card">
            <div class="top-section">
              <router-link to="/"><img :src="'/uploads/profile-images/'+request.user.profile_pic_filename" width="100%" /></router-link>
              <div class="details">
                <h4>{{request.user.fullname}}</h4>
                <span>{{request.user.age}} yrs</span> |
                <span>Female</span>
                <p>looking for an {{ request.space_type}}</p>
              </div>
            </div>
            <div class="bottom-section">
              <p v-if="request.about_property.length>45">{{request.about_property.substr(0,45) + '...' }}</p>
              <p v-else>{{request.about_property}}</p>
              <div class="c-t-b">
                <strong>Budget</strong>
                <span>&#8358;{{request.min_budget + '-' + request.max_budget}}</span>
              </div>
            </div>
          </router-link>
        
  </div>
</template>

<script>
export default {
  props: ["request"]
};
</script>

<style lang="scss" scoped>
.r-card {
  width: 100%;
  background: #f4f4f4;
  padding: 15px;
  margin-bottom: 10px;
  // clip-path:circle(300px at 0px 0px);

  & .top-section {
    display: flex;
    border-bottom: 1px solid #ddd;
    & img {
      width: 100px;
      height: 100px;
      border-radius: 50px;
      position: relative;
      // float:left;
    }

    & .details {
      width: 70%;
      padding: 10px;
      align-items: center;
      // text-align: center;

      & p {
        line-height: 16px;
        color: #0ca93f;
        font-weight: 700;
      }
    }
  }
  & .bottom-section {
    padding: 5px;
    & .c-t-b {
      display: flex;
      justify-content: flex-end;

      & strong {
        margin-right: 10px;
      }
    }
  }
}


</style>

