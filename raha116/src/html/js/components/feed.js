import {BaseComponent} from "../framework/base-component.js";
import {FeedService} from "../services/feed-service.js";
import './feed-creator.js';
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
    }

    connectedCallback() {
        super.connectedCallback();

        this.loadFeed();

    }

    async loadFeed() {
        const entries = await FeedService.instance.getFeed();

        console.log(entries);

        for (const entry of entries) {
            const feedEntry = new FeedEntry();
            feedEntry.entry = entry;
            this.feedList.appendChild(feedEntry);
        }
    }
}

customElements.define('zl-feed', Feed);