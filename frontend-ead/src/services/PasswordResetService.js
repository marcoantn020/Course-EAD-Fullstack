import BaseService from "@/services/BaseService";

export default class PasswordResetService extends BaseService{
    static async forgetPassword (params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post('/forgot-password', params)
                .then(response => {
                    resolve(response)
                })
                .catch(error => reject(error.response))
        })
    }

    static async updatePassword (params) {
        return new Promise((resolve, reject) => {
            this.request({ auth: false})
                .post('/reset-password', params)
                .then(response => {
                    resolve(response)
                })
                .catch(error => reject(error.response))
        })
    }

}