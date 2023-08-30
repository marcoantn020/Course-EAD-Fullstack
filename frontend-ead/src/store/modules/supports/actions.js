import SupportService from "@/services/SupportService";

const actions = {
    getSupportsByLesson({ commit }, lesson) {
        return SupportService.getSupportsByLesson(lesson)
            .then(response => commit('ADD_SUPPORTS', response))
    },

    storeSupport({ commit }, params) {
        return SupportService.storeSupport(params)
            .then(response => commit('ADD_NEW_SUPPORTS', response.data))
    },

    storeReplySupport({ commit }, params) {
        return SupportService.storeReplySupport(params)
            .then(response => commit('ADD_NEW_REPLY_SUPPORTS', response.data, params.support))
    },

    getMySupport({ commit }, params) {
        return SupportService.getMySupport(params)
            .then(response => commit('ADD_SUPPORTS', response))
    }
}

export default actions