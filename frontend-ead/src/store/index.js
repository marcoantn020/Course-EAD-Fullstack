import { createStore } from 'vuex'
import users from '@/store/modules/users'
import courses from '@/store/modules/courses'
import supports from '@/store/modules/supports'

export default createStore({
  state: {
    loading: false,
    msg: String
  },
  getters: {
  },
  mutations: {
    CHANGE_LOADING(state, status, msg = 'Congregant...') {
      state.loading = status
      state.msg = msg
    }
  },
  actions: {
  },
  modules: {
    users,
    courses,
    supports,
  }
})
