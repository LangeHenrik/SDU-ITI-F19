import {get, isSuccess, postFormData, sendDelete} from "./http-client.js";

export class FeedService {
    static instance = new FeedService();

    async getFeed() {
        const res = await get('/api/feed/');

        if (isSuccess(res)) {
            return res.item.reverse();
        } else {
            throw new Error("Failed to load feed.");
        }
    }

    /**
     * Adds a new feed entry
     * @param {File} image
     * @param {string} title
     * @param {string} description
     * @param updateCallback - A callback that will be invoked whenever the upload progresses
     * @return {Promise<{byThisUser: boolean, description: string, title: string, entryId: number, userId: number, imageUrl: string}>}
     */
    async addFeedEntry(image, title, description, updateCallback) {
        const data = new FormData();
        data.append('image', image, image.name);
        data.append('title', title);
        data.append('description', description);

        const res = await postFormData('/api/feed/', data, updateCallback);

        if (isSuccess(res)) {
            return res.item;
        }

        throw new Error("Failed to create feed entry: " + res.item.message);
    }

    /**
     * Deletes the specified entry
     * @param entryId
     * @return {Promise<void>}
     */
    async deleteEntry(entryId) {
        const res = await sendDelete(`/api/feed/?id=${entryId}`);

        if (isSuccess(res)) {
            return null;
        }

        throw new Error("Failed to delete entry");
    }

}