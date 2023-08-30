import BaseService from "@/services/BaseService";

export default class SupportService extends BaseService {
    static async getSupportsByLesson(lessonID) {
        return new Promise((resolve, reject) => {
            this.request()
                .get('/v1/supports', {
                    params: { lesson: lessonID}
                })
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => reject(error.response))
        })
    }

    static async storeSupport(params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post('/v1/supports', params)
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => reject(error.response))
        })
    }

    static async storeReplySupport(params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post(`/v1/supports/${params.support}/replies`, params)
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => reject(error.response))
        })
    }

    static async getMySupport(params = {}) {
        return new Promise((resolve, reject) => {
            this.request()
                .get(`/v1/my-supports`, {params})
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => reject(error.response))
        })
    }
}