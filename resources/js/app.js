require('./bootstrap');
import Vue from "vue"
import App from './App.vue'
import Router from 'vue-router'
import store from "./store";
import axios from "axios";
import i18n from "./i18n";
import vSelect from "vue-select";

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component("v-select", vSelect);

Vue.use(Router);

const lang = localStorage.getItem("lang") || "en";
axios.defaults.baseURL = "http://localhost:8000/api";
axios.defaults.headers.common["lang"] = lang;
Vue.config.productionTip = false;

let routes = [
    { path: '/', component: require("./components/Home.vue").default, meta: {auth: false} },

    { path: '/hotels',
        component: require("./components/Hotels.vue").default,
        name: "Hotels",
        props: true, //{ search: false, hotels: {} },
        meta: {auth: false}
    },
    { path: '/hotel/:id', component: require("./components/Hotels/SingleHotel.vue").default, meta: {auth: false} },

    { path: '/tours', component: require("./components/Tours.vue").default, meta: {auth: false} },
    { path: '/tour/:id', component: require("./components/Tours/SingleTour.vue").default, meta: {auth: false} },
];

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'active',
    routes: routes
});
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login');
        return
    }
    if (to.path === '/login' && loggedIn){
        next('/');
        return
    }
    next();
});
new Vue({
    router,
    store,
    i18n,
    created () {
        const userInfo = localStorage.getItem('user');
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit('setUserData', userData)
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )
    },
    render: h => h(App)
}).$mount('#app');
