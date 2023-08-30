import CourseService from "@/services/CourseService";

const actions = {
    getCourses({ commit }, params) {
        return CourseService.getCourses(params)
            .then(response => commit('ADD_COURSES', response.data))
    },

    lessonOfCourseCheckAsViewed({ commit, state }) {
        return CourseService.lessonOfCourseCheckAsViewed({lesson_id: state.playerLesson.id})
            .then(() => commit('ADD_NEW_VIEW_LESSON'))
    }
}

export default actions