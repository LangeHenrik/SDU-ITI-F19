import {isSuccess, post} from "./http-client.js";

export class CommentService {
    static instance = new CommentService();

    /**
     * Creates a new comment
     * @param {string} text
     * @param {number} feedEntryId
     * @return {Promise<void>}
     */
    async createComment(text, feedEntryId) {
        const res = await post('/api/comment/', {text, feedEntryId});

        if (isSuccess(res)) {
            return res.item;
        }

        throw new Error("Failed to create comment: " + res.item.message);
    }
}