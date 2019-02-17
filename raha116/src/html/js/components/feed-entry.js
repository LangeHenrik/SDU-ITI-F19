import {BaseComponent} from "../framework/base-component.js";
import {FeedService} from "../services/feed-service.js";
import './button.js';

const template = `<style>
    :host {
        display: grid;
        grid-template-rows: 2rem auto auto 2rem;
        grid-template-columns: repeat(4, 1fr);
        background-color: white;
        border: 1px solid var(--blurred-input);
        border-radius: 1px;
    }
    
    .image {
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        padding-top: 56.75%;
        grid-column: 1 / span 4;
        width: var(--feed-width);
        margin-left: -1px;
    }
    
    .title {
        margin: 0;
        grid-column: 1 / span 4;
        padding: 0.5rem;
        line-height: 1em;
    }
    
    .description {
        grid-column: 1 / span 4;
        margin: 0;
        padding: 0.5rem;
        border-bottom: 1px solid var(--blurred-input);
    }
    
    .hidden {
        display: none;
    }
    
    .delete-button {
        grid-column: 4 / 5;
    }
</style>

<h3 class="title"></h3>

<div class="image"></div>

<p class="description"></p>

<zl-button class="delete-button hidden">
    Delete
</zl-button>

`;

export class FeedEntry extends BaseComponent {
    static FEED_ENTRY_DELETED_EVENT_NAME = 'feedEntryDeleted';

    constructor() {
        super(template);

        this.titleElement = this.shadow.querySelector('.title');
        this.image = this.shadow.querySelector('.image');
        this.description = this.shadow.querySelector('.description');
        this.deleteButton = this.shadow.querySelector('.delete-button');
    }

    connectedCallback() {
        super.connectedCallback();

        this.deleteButton.addEventListener('click', async () => {
            FeedService.instance.deleteEntry(this._entry.entryId);

            // Assume the network requests succeeds
            this.dispatchEvent(new CustomEvent(FeedEntry.FEED_ENTRY_DELETED_EVENT_NAME, {
                detail: {
                    element: this,
                }
            }));
        });
    }

    /**
     * @type {{byThisUser: boolean, description: string, title: string, entryId: number, userId: number, imageUrl: string}}
     */
    _entry;

    get entry() {
        return this._entry;
    }

    set entry(value) {
        this._entry = value;
        this._renderEntry();
    }

    _renderEntry() {
        this.titleElement.innerText = this._entry.title;
        this.image.style.backgroundImage = `url(${this._entry.imageUrl})`;
        this.description.innerText = this._entry.description;
        this.deleteButton.classList.toggle('hidden', !this._entry.byThisUser);
    }
}

customElements.define('zl-feed-entry', FeedEntry);