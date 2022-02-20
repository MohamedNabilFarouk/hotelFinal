import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const state = {
    searchHotels: null,
    sidebarShow: 'responsive',
    sidebarMinimize: false,
    user: null
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
        axios.defaults.headers.common["user_id"] = userData.id;

        // axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
    },
    setSearchHotelsForm(state, formData){
        state.searchHotels = formData;
        localStorage.setItem('searchHotels', JSON.stringify(formData));
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
    }
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    getters
})
