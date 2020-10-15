<template>
    <div style="padding:20px">
       <div class="email-sent">
           <i class="fa fa-check-circle" aria-hidden="true"></i>
           <h1> A verificaion link has been sen to your email account</h1>
           <p>Please click on the link that has just been sent to your email acount to verify your email and coninue the sign up process.</p>
       </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.email-sent{
    padding: 20px;
    text-align: center;
    max-width: 600px;
    margin: auto;
    background: white;
    transform: translateY(-50px);
    position: relative;
    z-index: 999;

    h1{
       font-weight: 700;
    }

    i{
        color:#56b366;
        font-size:60px;
    }
}


@media (max-width:600px){
    .email-sent{
    transform: translateY(0px);
    text-align: left;
    h1{
       font-weight: 600;
       margin-top: 20px;
    }
    i{
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    }
   }
}
</style>