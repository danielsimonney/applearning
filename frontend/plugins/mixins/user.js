import Vue from 'vue'
import {mapGetters} from 'vuex'

const User = {
  install(Vue,options) {
    Vue.mixin({
      computed:{
        ...mapGetters({
          user:"profile/user",
          authenticated:"profile/authenticated"
        })
      }
    })
  }
}

Vue.use(User)