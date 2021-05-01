<template>
  <div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
             <path fill="#273036" fill-opacity="1" d="M0,64L40,53.3C80,43,160,21,240,16C320,11,400,21,480,58.7C560,96,640,160,720,154.7C800,149,880,75,960,69.3C1040,64,1120,128,1200,165.3C1280,203,1360,213,1400,218.7L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
      </svg>
      <footer>
            <div class="container">
                <div class="row">
                   <div class="col-md-4">
                       <div>
                           <div class="logo">
                              <img src="/images/logo.svg" alt="Proptybox logo" />
                           </div>
                          <p>
                              Proptybox is the first space renter and space sharing in Nigeria with a mission to make finding room rentals and finding great people to live with easy, affordable & safe using technology
                          </p>
                         
                       </div>
                   </div>       

                    <div class="col-md-4">
                       <div>
                          <h4>Important Links</h4>
                           <ul>
                            <router-link :to="{name:'about'}" tag="li">About us</router-link>
                            <router-link :to="{name:'terms'}" tag="li">Terms and conditon</router-link>
                        </ul>                  
                             <div class="playstore" data-toggle="modal" data-target="#modelId">
                              <img src="/images/google-play-badge-logo.png" width="100%" alt="Proptybox On Playstore" />
                          </div>
                       </div>
                   </div>       

                    <div class="col-md-4">
                       <div>
                           <h4>Contact us</h4>
                           <a href="mailto:hello@proptybox.com" style="color:rgba(245,245,245,0.8)">hello@proptybox.com</a><br>
                           <a href="mailto:proptyboxinfo@gmail.com"  style="color:rgba(245,245,245,0.8)">proptyboxinfo@gmail.com</a> 
                          <br><br>
                           <div class="socials">
                               <a href="https://m.facebook.com/Proptyboxcom-111928603706617/?view_public_for=111928603706617" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                               <a href="https://twitter.com/proptybox?s=20" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                               <a href="https://www.linkedin.com/in/proptybox-realestate-6765aa1a1" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                               <a href="https://www.instagram.com/proptybox/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                           </div>
                       </div>
                   </div>       
                </div>
            </div>
        </footer>


        <!-- Button trigger modal -->

        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Loading...</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Work in progress available soon.
                        </p>
                    </div>
                  
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            soon:false
        }
    },

    methods: {
        showSoon(){
            alert('comming soon')
        }
    },

}
</script>

<style lang="scss" scoped>

      footer{
      background:#273036;
      color:rgba($color: #fff, $alpha: 0.8);
      padding:10px;

      ul{
          margin:0px;
          padding:0px;
         li{
             list-style:none;
             cursor:pointer;
             color:#fff;
             padding:5px ;

         }
      }

      p{
          line-height:24px;
          margin:15px 0px;

      }

      h4{
          font-size:16px;
          color:#5895f9;
      }

      .socials{
          display:flex;
          justify-content: space-between;
          margin-top:10px;

          i{
              font-size:20px;
              cursor:pointer
          }
      }

      .playstore{
              height: 70px;
    width: 150px;
    cursor: pointer;
    position: relative;
          img{
              position: absolute;
                top: -33px;
                left: -15px;
          }
      }
  }

</style>