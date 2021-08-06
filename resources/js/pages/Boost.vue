<template>
  <div>
    <div class="header">
      <h4>Promotion</h4>
      <p>Reach More people</p>
    </div>
    <div class="container"></div>

    <div class="body">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="b-card" id="b-card" @click="checkBoost" amount="700">
              <h1>
                &#8358; 700
                <span>/ 7days</span>
              </h1>
              <input type="radio" value="700" v-model="amount" name="boost" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="b-card" id="b-card" @click="checkBoost" amount="1000">
              <h1>
                &#8358; 1000
                <span>/ 1 month</span>
              </h1>
              <input type="radio" value="1000" v-model="amount" name="boost" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="b-card" id="b-card" @click="checkBoost" amount="3000">
              <h1>
                &#8358; 3000
                <span>/ 3 month</span>
              </h1>
              <input type="radio" value="3000" v-model="amount" name="boost" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="features">
              <div class="header">
                <h4>Features</h4>
                <p>On average get 3x the amount of inquires</p>
              </div>
              <div class="body">
                <ul>
                  <li>
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Listing above search results
                  </li>
                  <li>
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Listing bumped up to the top daily
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <paystack
          v-if="user"
          :amount="amount * 100"
          :email="user.email"
          :paystackkey="paystackkey"
          :reference="reference"
          :callback="callback"
          :close="close"
          :embed="false"
          class="btn btn-primary"
          style="margin-left: 10px;margin-top: 10px;"
          :disabled="loadingV"
        >
          <i class="fas fa-money-bill-alt"></i>
          Make Payment
          <span v-if="loadingV">
            <i class="fa fa-spinner" aria-hidden="true"></i>
          </span>
        </paystack>
        <!-- <button class="btn btn-success " @click="makePay">Make Payment</button> -->
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import paystack from "vue-paystack";

export default {
  components: {
    paystack
  },
  data() {
    return {
      loadingV: false,
      pageNotFound: false,
      amount: "",
      verifying: false,
      paystackkey: "pk_live_a1e33f740e5dab84d89fc3485e0a3e19e4b397c1" //paystack public key
    };
  },
  methods: {
    makePay(response) {
      let data = {};
      data.amount = this.amount;
      data.listing = this.$route.params.id;
      data.reference = response.reference;
      this.loadingV = true;
      this.$store
        .dispatch("makePayment", data)
        .then(() => {
          this.loadingV = false;
          this.$snotify.success("You have successfully boost your list", {
            timeout: 6000,
            showProgressBar: true,
            pauseOnHover: true
          });
          this.$router.push({ name: "my.listing" });
        })
        .catch(() => {
          this.$snotify.error("Opps, something went wrong. Please try again");
        });
    },
    callback: function(response) {
      if (response.status === "success") {
        this.makePay(response);
      }
    },
    close: function() {
      this.$snotify.error("Opps, something went wrong. Please try again");
    },
    checkBoost(e) {
      let el = document.getElementsByClassName("b-card");
      for (let index = 0; index < el.length; index++) {
        const element = el[index];
        element.classList.remove("added");
      }
      if (e.target.classList.contains("b-card")) {
        e.target.classList.add("added");
        e.target.lastElementChild.checked = true;
        let amount = e.target.getAttribute("amount");
        this.amount = amount;
      }
    }
  },
  watch: {
    $route() {
      this.getUser();
    }
  },

  mounted() {
    window.eventBus.$emit('closeAd')
    this.loading = true;
    // this.getUser()
  },

  computed: {
    reference() {
      let text = "";
      let possible =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for (let i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
    },
    user() {
      return this.$store.getters.user;
    }
    //  ...mapGetters({isLoggedIn:'loggedIn',user:'user',profile:'profile'})
  }
};
</script>

<style lang="scss" scoped>
.features {
  border: 3px solid #eef4ff;

  .header {
    padding-left: 0px !important;
  }

  li {
    list-style: none;
    margin:15px 0px;

    i {
      color: #3490dc;
      font-size: 26px;
      top: 4px;
      position: relative;
    }
  }
}
.b-card {
  padding: 20px;
  background: white;
  box-shadow: 1px 2px 13px #ccc;
  margin: 10px;
  cursor: pointer;
  transition: 0.3s cubic-bezier(0.075, 0.82, 0.165, 1);
  &.added {
    transform: scale(1.05);
  }
  & h1 {
    font-size: 2.25rem;
    color: #3490dc;
  }

  & span {
    color: #444;
    font-size: 16px;
  }
}
.header {
  background: #eef4ff;
  padding: 10px;
  padding-left: 25px;

  & h4 {
    font-weight: 700;
  }
  & p {
    line-height: 0px;
    font-size: 16px;
  }
}
</style>