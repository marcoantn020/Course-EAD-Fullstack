import BaseService from "@/services/BaseService";

export default class CourseService extends BaseService {
    static async getCourses (params) {
        return new Promise((resolve, reject) => {
            this.request()
                .get('/v1/courses', params)
                .then(response => resolve(response.data))
                .catch(error => reject(error.response))
        })
    }

    static async lessonOfCourseCheckAsViewed (params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post('/v1/lessons/viewed', params)
                .then(response => resolve(response.data))
                .catch(error => reject(error.response))
        })
    }
}