import BaseService from "@/services/BaseService";
import {TOKEN_NAME} from "@/config";

export default class AuthService extends BaseService{

    static async auth (params) {
        return new Promise((resolve, reject) => {
            this.request({ auth: false })
                .post('/auth', params)
                .then(response => {
                    localStorage.setItem(TOKEN_NAME, response.data.token)
                    resolve(response)
                })
                .catch(error => reject(error.response))
        })
    }
    static async getUserAuth () {

        const token = localStorage.getItem(TOKEN_NAME)
        if(!token) {
            return Promise.reject("Token Not Found")
        }

        return new Promise((resolve, reject) => {
            this.request()
                .get('/me' )
                .then(response => resolve(response.data))
                .catch(error => {
                    localStorage.removeItem(TOKEN_NAME)
                    reject(error.response)
                })
        })
    }

    static async logout () {
        return new Promise((resolve, reject) => {
            this.request()
                .get('/logout' )
                .then(() => localStorage.removeItem(TOKEN_NAME))
                .catch(error => {
                    localStorage.removeItem(TOKEN_NAME)
                    reject(error.response)
                })
        })
    }

}