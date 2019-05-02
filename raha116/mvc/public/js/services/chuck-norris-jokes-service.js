import {get} from "./http-client.js";

const url = 'https://api.icndb.com/jokes/random';

export class ChuckNorrisJokesService {
    /**
     * Gets a joke
     * @returns {Promise<string>}
     */
    async getJokes() {
        const res = await get(url);

        return res.item.value.joke;
    }
}