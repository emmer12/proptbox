<template>
  <div class="container">
  
    <div class="row"  v-if="type==='list'">
      <div class="col-md-4 col-sm-6" v-for="(item, index) in 3" :key="index">
        <div class="loader-con-list loads">
          <div class="img-area"></div>
          <div class="details">
            <div></div>
            <div></div>
          </div>
          <div class="details-2"></div>
        </div>
      </div>
    </div>

    <br>

    <div class="row" style="background:#eef4ff" v-if="type==='pro'">
      <div class="col-md-12">
        <div class="loader-con-list loads">
           <div class="user-pro">
                 <div class="img-big-area"></div>
                 <div class="details">
                     <div></div>
                     <div></div>
                 </div>
           </div>
        </div>
      </div>
    </div>

     <div class="row" style="background:#eef4ff" v-if="type==='request'">
      <div class="col-md-12" v-for="(item, index) in 3" :key="index">
        <div class="loader-con-list loads">
           <div class="user-request">
                 <div class="img-big-area"></div>
                 <div class="details">
                     <div></div>
                     <div></div>
                 </div>
           </div>
        </div>
      </div>
    </div>


    <div class="row l-details" v-if="type==='details'">
      <div class="col-md-12" style="margin:0px auto;max-width:550px">
        <div class="loader-con-list loads">
                 <div class="img-area"></div>
                 <div class="details-d">
                     <div></div>
                     <div></div>
                 </div>
                  <div class="details-d">
                     <div></div>
                     <div></div>
                 </div>
                  <div class="details-d">
                     <div></div>
                     <div></div>
                 </div>
                  <div class="details-d">
                     <div></div>
                     <div></div>
                 </div>
           </div>
        </div>
      </div>
    </div>

</template>

<script>
export default {
    props: ['type']
};
</script>

<style lang="scss" scoped>
.l-details{
  transform: translateY(-100px);
}
.loader-con-list {
  background: #444;
//   height: 260px;
  width: 100%;
  position: relative;
  overflow: hidden;
  box-sizing: border-box;

  & .details,.details-d{
      display:flex;
      justify-content: space-between;
      & div{
      margin:10px;
      height:40px;
      width:120px;
      background: rgba(255, 255, 255, 0.5);
      }
  }

  & .details-d{
      & div{
      width:45%;

      }

  }

  & .user-pro,.user-request{
      display:flex;
      padding:10px;
      & .img-big-area{
          height:150px;
          width:150px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.5);
      }
      & .details{
          width:50%;
          display:flex;
          flex-direction: column;
          justify-content: flex-start;
          margin-left:20px;
          & div:last-child{
              width:30%
          }
          & div{
          background: rgba(255, 255, 255, 0.5);
          height:30px;
          width:50%;

          }
                 
      }
  }

  & .user-request{
    & .img-big-area{
          height:100px;
          width:100px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.5);
      }
  }

  & .details-2{
      height:70px;
      background:rgba(255, 255, 255, 0.5);
      margin:10px;

  }

  & .img-area {
    height: 180px;
    background: rgba(255, 255, 255, 0.5);
    padding: 10px;
    margin: 10px;
    border-radius: 3px;
    position: relative;
    overflow: hidden;
    top: 12px;
  }
}
.loads {
  background: #b0c7f37e;
  margin-top:10px;
  &::after {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    background: linear-gradient(
      90deg,
      transparent,
      rgba(255, 255, 255, 0.5),
      transparent
    );
    animation: loading 1s infinite backwards;
    top: 0px;
    left: 0px;
    transform: translateX(-100%);
  }
}

@keyframes loading {
  100% {
    transform: translateX(100%);
  }
}
</style>