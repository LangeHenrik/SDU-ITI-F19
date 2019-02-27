import {BaseComponent} from "../framework/base-component.js";
import {CommentService} from "../services/comment-service.js";
import {FormHandler} from "../services/form-handler.js";
import './comment.js';
import {Comment} from "./comment.js";

const template = `
<style>
    @import url('style/forms.css');
    
    .new-comment {
        display: grid;
        grid-template-columns: 3fr 1fr;
        grid-template-rows: 1fr;
    }
    
    .input-wrapper {
        margin-bottom: 0;
    }
</style>

<div class="existing-comments">
</div>
<form class="new-comment" id="new-comment-form">
    <div class="input-wrapper">
        <textarea class="comment-input input" id="comment-text" name="text"></textarea>
    </div>
    
    <zl-button id="fake-submit-button">Send comment</zl-button>
    
    <button class="hidden-submit-button" type="submit">Submit</button>
</form>
`;

export class Comments extends BaseComponent {
    constructor() {
        super(template);

        this.createNewComment = this.createNewComment.bind(this);
        this.existingComments = this.shadow.querySelector('.existing-comments');
    }

    static get observedAttributes() {
        return ['entry-id'];
    }

    get entryId() {
        return parseInt(this.getAttribute('entry-id'), 10);
    }

    set entryId(value) {
        this.setAttribute('entry-id', value);
    }

    /**
     *
     * @type {Array<{text: string, userId: number, byThisUser: boolean, commentId: number, feedEntryId: number}>}
     * @private
     */
    _comments = [];

    get comments() {
        return this._comments;
    }

    set comments(value) {
        this._comments = value;
        this._renderComments();
    }

    connectedCallback() {
        super.connectedCallback();

        const form = this.shadow.querySelector('#new-comment-form');
        const fakeSubmitButton = this.shadow.querySelector('#fake-submit-button');

        this.form = new FormHandler(form, fakeSubmitButton);

        form.addEventListener('submit', this.createNewComment);

    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (name) {
            case 'entry-id':
                break;
        }
    }

    _renderComments() {
        for (const comment of this.comments) {
            const commentElement = new Comment();
            commentElement.byThisUser = comment.byThisUser;
            commentElement.innerText = comment.text;
            this.existingComments.appendChild(commentElement);
        }
    }

    async createNewComment() {
        const {text} = this.form.getValues();

        await CommentService.instance.createComment(text, this.entryId);

        console.log('created comment');
    }

}

customElements.define('zl-comments', Comments);