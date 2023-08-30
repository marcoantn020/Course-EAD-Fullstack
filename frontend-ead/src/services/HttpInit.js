import {TOKEN_NAME, URL_API} from "@/config";
import axios from "axios";

export default class HttpInit{
    constructor(status) {
        const token = localStorage.getItem(TOKEN_NAME)
        const headers = status.auth === true ? {
            Authorization: `Bearer ${token}`
            } : {}

        this.instance = axios.create({
            baseURL: URL_API,
            headers: headers
        })

        return this.instance
    }
}