import Vue from "vue";
import axios from "axios";
import VueAxios from 'vue-axios'
import Vuetify from "vuetify/lib";
import "vuetify/dist/vuetify.min.css";
import App from "./App.vue";
import { store } from './store/store.js';
// import router from "./router";

Vue.use(Vuetify);
Vue.use(VueAxios, axios);
// Vue.config.productionTip = false;
/* eslint-disable no-new */
window.addEventListener("load", function() {
  new Vue({
    el: "#projects",
    // router,
    store,
    vuetify: new Vuetify(),
    render: (h) => h(App),
  });
});