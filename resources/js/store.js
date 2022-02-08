import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const state = {
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
        axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
    },

    clearUserData () {
        localStorage.removeItem('user');
        if (location.pathname !== '/login'){
            location.reload();
        }
    }
};
const actions = {
    login ({ commit }, credentials) {
        return axios
            .post('login', credentials)
            .then(({ data }) => {
                commit('setUserData', data)
            })
    },
    logout ({ commit }) {
        commit('clearUserData')
    }
};
const getters = {
    isLogged: state => !!state.user,
    user(state) {
        return state.user;
    }
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    getters
})
