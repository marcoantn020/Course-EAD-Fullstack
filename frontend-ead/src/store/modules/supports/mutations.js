const mutations = {
    ADD_SUPPORTS (state, supports) {
        state.supports_items = Object.assign({}, state.supports_items, supports)
    },

    ADD_NEW_SUPPORTS (state, support) {
        state.supports_items.data.unshift(support)
    },

    ADD_NEW_REPLY_SUPPORTS (state, replySupport) {
        const supports = state.supports_items.data
        supports.forEach((support) => {
            if(support.id === replySupport.support.id) {
                support.replies = replySupport.support.replies
                return
            }
        })

        state.supports_items.data = supports
    },

    reset_SUPPORTS (state) {
        state.supports_items = {
            data: [],
            meta: {
                total: 0,
                page: 0,
                last_page: 0,
            }
        }
    }
}

export default mutations