import {get} from "./http-client.js";

const url = './api/strategy';

export class FuckAsAServiceService {

    /**
     *
     * @param {number} numberOfFucks
     * @returns {Promise<string>}
     */
    async getFucks(numberOfFucks) {
        const res = await get(`https://faas.unnecessary.tech/v1/give/${numberOfFucks}/fucks`);

        if (res.item.status === 'ok') {
            return res.item.fucks;
        } else {
            return res.item.message;
        }
    }
}