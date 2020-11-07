<template>
  <div class="about-2">
    <div class="banner">
      <h4>About us</h4>
      <div>
        <img src="/svg/about.svg" width="200px" />
      </div>
    </div>

    <div class="body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-sm-12 col-xs-12">
            <p>It is exciting when people can tour cities or connect with great people either down the street or across the country all at the click of buttons. We are the biggest and first online real estate community that focuses on space rentals and space sharing in Nigeria.</p>
            <p>Our mission is to make finding vacant space and space co-habitants fast, seamless and safe. We optimize great technology to make finding great people fun, and creating fantastic users’ experience.</p>
          </div>
        </div>

        <div class="row justify-content-center">
          <section class="col-md-6 col-sm-12 col-xs-12">
            <div class="heading">
              <h4>How to list your space on Proptybox.com?</h4>
            </div>

            <div class="body">
              <ul>
                <li>
                  <strong>Register:</strong> Register using your e-mail and phone number. Make sure you’re entering a correct phone number, so your clients could reach you!
                </li>
                <li>
                  <strong>Make photos of your item:</strong> Feel free to make a lot of photos using your smartphone. Make sure they show your property in the best light.
                </li>
                <li>
                  <strong>Tell people about the space:</strong> Click on list button and fill the form as appropriate. Choose a proper category, upload your photos and write a clear title and full description of your item. Enter a fair price, select attributes and send your advert to review!
                </li>
                <li>
                  <strong>Press Submit:</strong> Review the information you supplied and submit when you are done. Pimm! You are ready to connect with great people and do business.
                </li>
              </ul>
            </div>
          </section>
        </div>

        <div class="row justify-content-center">
          <section class="col-md-6 col-sm-12 col-xs-12">
            <div class="heading">
              <h4>How to Find and share space on Proptybox.com ?</h4>
            </div>

            <div class="body">
              <ul>
                <li>
                  <strong>Search for the item:</strong>Find what you need using search panel and filters, and choose exactly what you are looking for
                </li>
                <li>
                  <strong>Request:</strong> Request. Get what you want in a more swift way by creating a request of what you need. Your request will be shared with potential service providers.
                </li>
                <li>
                  <strong>Contact a seller:</strong> You may use chat on Proptybox or call them via phone. Discuss all the details, negotiate about the property you intend to buy.
                </li>
                <li>
                  <strong>Leave comments about the seller:</strong>Feel free to tell your story or feedback via the comments box about any property adverts on Proptybox.com. Your feedback/comments/Story will be useful to other buyers. Let’s build a safe and professional business community together!
                </li>
              </ul>
            </div>
          </section>
        </div>

        <div class="row justify-content-center">
          <section class="col-md-6 col-sm-12 col-xs-12">
            <div class="heading">
              <h4>Safety</h4>
            </div>

            <div class="body">
              <ul>
                <li>
                  <strong>General:</strong>We are highly interested in your safety and we solve any issues in shortest time, that’s why we ask you, kindly, to leave a review after purchasing. If you run into any problems with an agent or a developer, you can report to us (Contact us) and Proptybox team will check this agent/developers as soon as possible.
                </li>
                <li>
                  <strong>Personal safety tips</strong>.
                  <ul>
                    <li>Do not pay in advance, even part-payment.</li>
                    <li>Try to meet at a safe, public location.</li>
                    <li>Check the space BEFORE you make commitment.</li>
                    <li>Pay only after legal documentations and agreements.</li>
                  </ul>
                </li>
              </ul>
            </div>
          </section>
        </div>

        <div class="row justify-content-center">
          <section class="col-md-6 col-sm-12 col-xs-12">
            <div class="heading">
              <h4>Sell</h4>
            </div>

            <div class="body">
              <ul>
                <li>
                  <strong>Pay attention to the details:</strong>Make good photos of your property, write clear and detailed description.
                </li>
                <li>
                  <strong>Answer quickly:</strong>Don’t make your buyer wait for your message for days. Be online or check notifications on your messages.
                </li>
                <li>
                  <strong>Use Premium Services to get 15x more customers!:</strong>Your post will appear at the top of the page, get on-the-go notification, track and follow up with users that view your post.
                </li>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>

    <footer-b></footer-b>
  </div>
</template>

<script>
import FooterB from './../partials/Footer'
export default {
  components: {
    FooterB
  }
};
</script>


<style lang="scss" scoped>
.about-2 {
  .banner {
    height: 200px;
    // background:rgb(173, 3, 3);
    background: #eef4ff;

    h4 {
      color: #333;
      font-weight: 700;
      position: relative;
      top: 50%;
      margin-left: 40px;
      padding: 10px;
      border-left: 4px solid #5895f9;
      &::before {
        content: "";
        position: absolute;
        height: 4px;
        width: 50px;
        background: #5895f9;
        bottom: 0px;
        left: -10px;
      }
    }

    div {
      //   float: right;
      top: -30px;
      position: relative;

      img {
        display: block;
        position: absolute;
        right: 20px;
      }
    }
  }

  .body {
    margin-top: 33px;
    padding: 10px;
    p {
      font-size: 16px;
    }
  }
}
</style>