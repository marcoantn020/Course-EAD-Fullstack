import HttpInit from "@/services/HttpInit";

export default class BaseService {

    constructor() {
        this.instance = new BaseService
    }

    static request (status = { auth : true}) {
        return new HttpInit(status)
    }

}