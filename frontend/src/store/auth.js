import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loggedIn: false,
    user: {},
    token: process.env.VUE_APP_TOKEN
  },
  mutations: {

  },
  getters: {
    auth(state) {
      return state.user
    },
    token(state) {
      return state.token
    },
  }
})
