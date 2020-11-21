<template>
  <div>
          <router-link tag="div" :to="{name:'request-details',params:{id:request.id}}" class="card r-card">
            <div class="top-section">
              <router-link :to="{name:'profile',params:{id:request.user.id}}"><img :src="'/uploads/profile-images/'+request.user.profile_pic_filename" width="100%" /></router-link>
              
              <div class="details">
                 <div class="location">
                  <span v-if="request.space_location.length>30"><i class="fa fa-map-marker" aria-hidden="true"></i> {{request.space_location.substr(0,30) + '...' }}</span>
                  <span v-else><i class="fa fa-map-marker" aria-hidden="true"></i> {{request.space_location }}</span>
                </div>
                 <h4 v-if="request.user.fullname.length > 10">{{request.user.fullname.substr(0,10) + '...'}}</h4>
                <h4 v-else>{{request.user.fullname}}</h4>
                <span>{{request.user.age}} yrs</span> | <span>{{ request.user.gender}}</span>
                <p>looking for {{ request.space_for == 'Rent' ? 'an apartment' : 'a roommate' }}</p>
              </div> 
            </div>
            <div class="bottom-section">
              <!-- <p v-if="request.about_property.length>25">{{request.about_property.substr(0,25) + '...' }}</p> -->
              <!-- <p v-else>{{request.about_property}}</p> -->
              <div class="c-t-b">
                <strong>Budget</strong>
                <span v-if=" request.max_budget.length > 4">&#8358;{{request.min_budget + '-' + request.max_budget.substr(0,4) + '..'}}</span>
                <span v-else>&#8358;{{request.min_budget + '-' + request.max_budget}}</span>
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
  width: 230px;
  background: #f4f4f4;
  padding: 15px;
  margin: 10px;
  height:230px;
  padding-top: 37px;
  // clip-path:circle(300px at 0px 0px);
  .location{
    position: absolute;
    right: 0px;
    top: 0px;
    padding: 10px;
    font-weight: 600;
    color: #222;
  }
  & .top-section {
    display: flex;
    border-bottom: 1px solid #ddd;
    & img {
      width: 70px;
      height: 70px;
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
      // white-space: nowrap;

      & strong {
        margin-right: 10px;
      }
    }
  }
}


</style>

