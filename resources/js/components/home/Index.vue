<template>
     <div class="relative viewPage">
          <!-- <div class="circleTop">
               <img src="/frontend/circle.png" />
          </div> -->
          <div class="pageHome container">
               <form-code v-if="boolCode!=true"></form-code>
               <form-register v-if="boolCode"></form-register>
          </div>
          <!-- <div class="circleBottom">
               <img src="/frontend/circle2.png" />
          </div> -->
          <footer-main></footer-main>
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     computed: {
          ...mapGetters({
               boolCode: 'user/getBoolCode',
          })
     },
     mounted(){
          // console.log(this.boolCode)
          this.$store.commit('user/setReset', '')
     },
}
</script>
