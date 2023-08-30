import AuthService from "@/services/AuthService";
import PasswordResetService from "@/services/PasswordResetService";

export default {
    state: {
        user: {
            name: '',
            email: '',
        },
        loggedIn: false
    },

    getters: {
    },

    mutations: {
        SET_USER (state, user) {
            state.user = user
            state.loggedIn = true
        },
        LOGOUT (state) {
            state.user = {
                name: '',
                email: '',
            }
            state.loggedIn = false
        }
    },

    actions: {
        auth({ dispatch }, params) {
            return AuthService.auth(params)
                .then(() => dispatch('getUserAuth'))
        },

        forgetPassword(_, params) {
            return PasswordResetService.forgetPassword(params)
        },

        updatePassword(_, params) {
            return PasswordResetService.updatePassword(params)
        },

        getUserAuth({ commit }) {
            commit('CHANGE_LOADING', true)
            AuthService.getUserAuth()
                .then(response => {
                    commit('SET_USER', response.data)
                })
                .finally(() => commit('CHANGE_LOADING', false))
        },

        logout({ commit }) {
            AuthService.logout()
                .then(() => commit('LOGOUT'))
        }
    }
}