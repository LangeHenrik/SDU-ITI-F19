import {isSuccess, postFormData} from "./http-client.js";

export class FeedService {
    static instance = new FeedService();

    async getFeeds() {

    }

    /**
     * Adds a new feed entry
     * @param {File} image
     * @param {string} title
     * @param {string} description
     * @param updateCallback - A callback that will be invoked whenever the upload progresses
     * @return {Promise<void>}
     */
    async addFeedEntry(image, title, description, updateCallback) {
        const data = new FormData();
        data.append('image', image, image.name);
        data.append('title', title);
        data.append('description', description);

        console.log('adding feed entry');
        const res = await postFormData('/api/feed/', data, updateCallback);

        if (isSuccess(res)) {
            return res.item;
        }

        throw new Error("Failed to create feed entry: " + res.item.message);
    }

}