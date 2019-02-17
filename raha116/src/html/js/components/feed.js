import {BaseComponent} from "../framework/base-component.js";
import {FeedService} from "../services/feed-service.js";
import {UserState} from "../services/user-state.js";
import './feed-creator.js';
import {FeedCreator} from "./feed-creator.js";
import './feed-entry.js';
import {FeedEntry} from "./feed-entry.js";

const template = `<style>
    .feed-list {
        display: grid;
        grid-gap: 1rem;
        padding-top: 1rem;
    }
</style>

<zl-feed-creator></zl-feed-creator>

<div class="feed-list">
    
</div>
`;

export class Feed extends BaseComponent {
    constructor() {
        super(template);

        this.feedList = this.shadow.querySelector('.feed-list');

        this.feedCreator = this.shadow.querySelector('zl-feed-creator');

        this.loadFeed = this.loadFeed.bind(this);

        this.handleAddedEntry = this.handleAddedEntry.bind(this);
    }

    connectedCallback() {
        super.connectedCallback();

        this.loadFeed();

        UserState.instance.addEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, this.loadFeed);

        this.feedCreator.addEventListener(FeedCreator.FEED_ENTRY_CREATED_EVENT_NAME, this.handleAddedEntry);
    }

    disconnectedCallback() {
        super.disconnectedCallback();

        UserState.instance.removeEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, this.loadFeed);
    }

    async loadFeed() {
        this.feedList.innerHTML = '';

        if (!UserState.instance.isLoggedIn) {
            console.log('user is not authenticated. Ignoring feed');
            return;
        }

        const entries = await FeedService.instance.getFeed();

        for (const entry of entries) {
            const feedEntry = new FeedEntry();
            feedEntry.entry = entry;
            this.feedList.appendChild(feedEntry);
        }
    }

    handleAddedEntry(event) {
        const entry = event.detail.entry;
        console.log('entry was added', event, entry);

        const feedEntry = new FeedEntry();
        feedEntry.entry = entry;
        this.feedList.insertBefore(feedEntry, this.feedList.firstChild);
    }
}

customElements.define('zl-feed', Feed);