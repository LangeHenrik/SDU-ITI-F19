import '../components/comment.js';
import {BaseComponent} from "../framework/base-component.js";
import {CommentService} from "../services/comment-service.js";
import {FormHandler} from "../services/form-handler.js";
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
    
    .existing-comments {
        padding-top: 1rem;
        padding-bottom: 1rem;
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 1rem;
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

        this.textarea = this.shadow.querySelector('#comment-text');
    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (name) {
            case 'entry-id':
                break;
        }
    }

    _renderComments() {
        for (const comment of this.comments) {
            const commentElement = this._createCommentElement(comment);
            this.existingComments.appendChild(commentElement);
        }
    }

    _createCommentElement(comment) {
        const commentElement = new Comment();
        commentElement.byThisUser = comment.byThisUser;
        commentElement.innerText = comment.text;
        return commentElement;
    }

    async createNewComment() {
        const {text} = this.form.getValues();

        if (!text.trim()) {
            return;
        }

        const comment = await CommentService.instance.createComment(text, this.entryId);

        this.form.clear();

        this._animateNewCommentIn(comment);

    }

    _animateNewCommentIn(comment) {
        const commentElement = this._createCommentElement(comment);

        this.existingComments.appendChild(commentElement);

        const {top, left, height, width} = commentElement.getBoundingClientRect();

        const {top: textTop, left: textLeft, height: textHeight, width: textWidth} = this.textarea.getBoundingClientRect();

        const fakeComment = this._createFakeComment(commentElement);

        this.existingComments.appendChild(fakeComment);

        const animation = commentElement.animate([
            {
                transform: `translate(${textLeft}px, ${textTop}px)`,
                height: `${textHeight}px`,
                width: `${textWidth}px`,
                top: `0px`,
                left: `0px`,
                margin: 0,
                position: 'fixed'
            },
            {
                transform: `translate(${left}px, ${top}px)`,
                height: `${height}px`,
                width: `${width}px`,
                top: `0px`,
                left: `0px`,
                margin: 0,
                position: 'fixed'
            }
        ], {
            duration: 500,
            easing: 'ease-in-out'
        });

        animation.addEventListener('finish', () => {
            this.existingComments.removeChild(fakeComment);
        });
    }

    /**
     * Creates a fake comment element
     * @param commentElement
     * @private
     */
    _createFakeComment(commentElement) {
        const {offsetHeight, offsetWidth} = commentElement;

        const div = document.createElement('div');

        div.style.height = `${offsetHeight}px`;
        div.style.width = `${offsetWidth}px`;

        div.animate([
            {
                height: '0',
            },
            {
                height: `${offsetHeight}px`
            }
        ], {
            duration: 400,
            easing: 'ease-in-out'
        });

        return div;
    }

}

customElements.define('zl-comments', Comments);