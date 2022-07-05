import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store/auth'
import axios from 'axios';
import moment from 'moment'

Vue.config.productionTip = false;

axios.interceptors.request.use((request) => {
  request.baseURL = process.env.VUE_APP_API_URL

  const token = store.getters.token
  if (token) {
    request.headers.common.Authorization = `Bearer ${token}`
  }

  return request
})
Vue.prototype.$http = axios;

Vue.filter('formatDate', (value) => value ? moment(String(value)).format('DD-MM-YYYY') : '')

/* eslint-disable no-new */
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
