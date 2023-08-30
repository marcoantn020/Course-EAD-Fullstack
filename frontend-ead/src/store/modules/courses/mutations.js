const mutations = {
    ADD_COURSES (state, courses) {
        state.courses_items = courses
    },

    SET_COURSE_SELECTED (state, course) {
        state.course_selected = course
    },

    SET_PLAYER (state, lesson) {
        state.playerLesson = lesson
    },

    ADD_NEW_VIEW_LESSON (state) {
        const modules = state.course_selected.modules
        modules.forEach((module, indexModule) => {
            module.lessons.forEach((lesson, index) => {
                if(lesson.id === state.playerLesson.id) {
                    modules[indexModule].lessons[index].views.push({})
                    return
                }
            })
        })
    },

    REMOVE_PLAYER (state) {
        state.player = {
            id: '',
            name: '',
            video: '',
            views: []
        }
    }
}

export default mutations