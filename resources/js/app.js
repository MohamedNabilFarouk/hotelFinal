require('./bootstrap');
import Vue from "vue"
import App from './App.vue'
import Router from 'vue-router'
import store from "./store";
import axios from "axios";
import i18n from "./i18n";
import vSelect from "vue-select";
import VModal from 'vue-js-modal';
import moment from 'moment';
import Notifications from 'vue-notification';

Vue.component('VuePhoneNumberInput', require('vue-phone-number-input'));

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component("v-select", vSelect);

Vue.use(Router);
Vue.use(VModal,  { componentName: 'modal' });
Vue.use(Notifications);


const lang = localStorage.getItem("lang") || "en";
axios.defaults.baseURL = "http://localhost:8000/api";
axios.defaults.headers.common["lang"] = lang;
Vue.config.productionTip = false;

const country =  localStorage.getItem("country") || null;
if (country){
    axios.defaults.headers.common["country"] =  country;
}else {

    fetch("https://ipinfo.io/json?token=eff8d09c8a179d").then((response) => response.json())
        .then((jsonResponse) => {
                localStorage.setItem("country", jsonResponse.country);
                axios.defaults.headers.common["country"] =  jsonResponse.country;
            }
        );
}

Vue.filter('date', function(date){
    return moment(date).format('YYYY-MMM-Do dddd, h:mm a');
    // const a = moment(date1);
    // const b = moment(date2);x
    // return a.diff(b, 'days');
});

let routes = [
    { path: '/', component: require("./components/Home.vue").default, name: "Home", meta: {auth: false} },

    { path: '/hotels', component: require("./components/Hotels.vue").default, name: "Hotels", props: true, meta: {auth: false}},
    { path: '/hotel/:id', component: require("./components/Hotels/SingleHotel.vue").default, name: "Hotel", meta: {auth: false} },

    { path: '/tours', component: require("./components/Tours.vue").default, name: "Tours", props: true, meta: {auth: false} },
    { path: '/tour/:id', component: require("./components/Tours/SingleTour.vue").default, name: "Tour", meta: {auth: false} },
    { path: '/tours/special', component: require("./components/SpecialTours.vue").default, name: "SpecialTours", props: true, meta: {auth: false} },

    { path: '/become-a-vendor', component: require("./components/BecomeVendor.vue").default, name: "BecomeVendor", meta: {auth: false} },
    { path: '/vendor-terms-and-conditions', component: require("./components/BecomeVendorConditions.vue").default, name: "BecomeVendorConditions", meta: {auth: false} },

    { path: '/profile', component: require("./components/Profile.vue").default, name: "Profile", meta: {auth: false} },


];

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'active',
    routes: routes,
    scrollBehavior() {
        return {x: 0, y: 0}
    }
});

// router.beforeEach((to, from, next) => {
//     const loggedIn = localStorage.getItem('user');
//     if (to.matched.some(record => record.meta.auth) && !loggedIn) {
//         next('/login');
//         return
//     }
//     if (to.path === '/login' && loggedIn){
//         next('/');
//         return
//     }
//     next();
// });

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
        const searchHotels = localStorage.getItem('searchHotels');
        if (searchHotels) {
            const formData = JSON.parse(searchHotels);
            this.$store.commit('setSearchHotelsForm', formData)
        }
        const searchTours = localStorage.getItem('searchTours');
        if (searchTours) {
            const formData = JSON.parse(searchTours);
            this.$store.commit('setSearchToursForm', formData)
        }
        // axios.interceptors.response.use(
        //     response => response,
        //     error => {
        //         if (error.response.status === 401) {
        //             this.$store.dispatch('logout')
        //         }
        //         return Promise.reject(error)
        //     }
        // )
    },
    render: h => h(App)
}).$mount('#app');
