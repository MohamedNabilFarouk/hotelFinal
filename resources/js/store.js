import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const state = {
    searchHotels: null,
    searchTours: null,
    sidebarShow: 'responsive',
    sidebarMinimize: false,
    user: null,
    currency: null
};

const mutations = {
    toggleSidebarDesktop (state) {
        const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow);
        state.sidebarShow = sidebarOpened ? false : 'responsive'
    },
    toggleSidebarMobile (state) {
        const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow);
        state.sidebarShow = sidebarClosed ? true : 'responsive'
    },
    set (state, [variable, value]) {
        state[variable] = value
    },
    setUserData (state, userData) {
        state.user = userData;
        localStorage.setItem('user', JSON.stringify(userData));
        axios.defaults.headers.common["id"] = userData.id;

        axios.defaults.headers.common.Authorization = `${userData.token}`
    },
    setSearchHotelsForm(state, formData){
        state.searchHotels = formData;
        localStorage.setItem('searchHotels', JSON.stringify(formData));
    },
    setCurrency(state, c){
        state.currency = c;
        localStorage.setItem('currency', JSON.stringify(c));
    },
    setSearchToursForm(state, formData){
        state.searchTours = formData;
        localStorage.setItem('searchTours', JSON.stringify(formData));
    },
    clearSearchHotelsForm(){
        state.searchHotels = null;
        localStorage.removeItem('searchHotels');
    },
    clearUserData () {
        state.user = null;
        localStorage.removeItem('user');
    }
};
const actions = {
    login ({ commit }, credentials) {
        return axios
            .post('user/login', credentials)
            .then(({ data }) => {
                commit('setUserData', data.data)
            })
    },
    searchHotels ({ commit }, formData){
        return  commit('setSearchHotelsForm', formData)
    },
    currency({ commit }, c) {
        return  commit('setCurrency', c)
    },
    searchTours ({ commit }, formData){
        return  commit('setSearchToursForm', formData)
    },
    clearSearchHotels ({ commit }){
        return  commit('clearSearchHotelsForm')
    },
    logout ({ commit }) {
        commit('clearUserData')
    }
};
const getters = {
    isLogged: state => !!state.user,
    user(state) {
        return state.user;
    },
    searchHotels(state){
        return state.searchHotels;
    },
    currency(state){
        return state.currency;
    },
    searchTours(state){
        return state.searchTours;
    }
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    getters
})
