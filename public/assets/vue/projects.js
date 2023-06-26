import Vue from "vue";
import Vuetify from "vuetify/lib";
import App from "./App.vue";
import router from "./router";

Vue.use(Vuetify);
// Vue.config.productionTip = false;
/* eslint-disable no-new */
window.addEventListener("load", function() {
  new Vue({
    el: "#projects",
    router,
    vuetify: new Vuetify(),
    render: (h) => h(App),
  });
});

