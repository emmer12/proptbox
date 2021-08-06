<template>
    <div class="session">
        <transition name="fade" enter-active-class="animated fadeIn"  leave-active-class="animated fadeOut" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>

</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
  .session{
    background:#eef4ff;
    height:100vh;
    width:100%;
  }
</style>