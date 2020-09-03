<template>
  <div>
     <div class="card r-card">
      <div class="top-section">
        <img src="/images/user.png" width="100%" />
        <div class="details">
          <h4>James Bruse</h4>
          <span>12yrs </span> | <span>Female</span>
           <p> james is looking for an apartment</p>
        </div>
      </div>
       <div class="bottom-section">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse autem po...</p>
         <div class="c-t-b">
             <strong>Budget</strong>
             <span>$200</span>
         </div>
       </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.r-card {
  width: 100%;
  background: #f4f4f4;
  padding:15px;
  // clip-path:circle(300px at 0px 0px);

  & .top-section{
    display:flex;
    border-bottom: 1px solid #ddd;
    & img{
      width:100px;
      height:100px;
      border-radius: 50px;
      position:relative;
      // float:left;
      
    }

    & .details{
      width:70%;
      padding:10px;
      align-items:center;
      // text-align: center;

      & p{
        line-height:16px;
        color: rgba($color:green, $alpha: 0.5);
        font-weight: 700;
      }
    }

  }
      & .bottom-section{
        padding:5px;
        & .c-t-b{
          display:flex;
          justify-content: flex-end;

          & strong{
            margin-right:10px
          }
        }
      }
}
</style>