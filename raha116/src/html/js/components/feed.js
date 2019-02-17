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

    /**
     * A map of all the existing positions. Initialized before a move
     * @type Map<HTMLElement, {top: number, left: number}>
     */
    existingEntryPosition;

    handleAddedEntry(event) {
        const entry = event.detail.entry;

        this.prepareExistingEntryMoving();

        const feedEntry = new FeedEntry();
        feedEntry.entry = entry;
        this.feedList.insertBefore(feedEntry, this.feedList.firstChild);

        this.animateNewFeedEntry(feedEntry);
        this.runExistingEntryMoving();
    }

    prepareExistingEntryMoving() {
        const map = new Map();

        const entries = this.shadow.querySelectorAll('zl-feed-entry');

        for (const entry of entries) {
            const {offsetTop, offsetLeft} = entry;
            map.set(entry, {top: offsetTop, left: offsetLeft});
        }

        this.existingEntryPosition = map;
    }

    runExistingEntryMoving() {
        if (!this.existingEntryPosition) {
            return;
        }

        for (const [element, {top, left}] of this.existingEntryPosition) {
            const {offsetTop, offsetLeft} = element;

            element.animate([
                {transform: `translate(${left - offsetLeft}px, ${top - offsetTop}px)`},
                {transform: 'translate(0, 0)'}
            ], {
                duration: 250,
                easing: 'ease-in-out'
            });
        }

        this.existingEntryPosition = null;
    }

    animateNewFeedEntry(feedEntry) {
        console.log('animating feed entry', feedEntry);
        feedEntry.animate([
            {transform: 'translateY(-100%)', opacity: '0'},
            {transform: 'translateY(0)', opacity: '1'},
        ], {
            duration: 250,
            easing: 'ease-in-out',
        });
    }
}

customElements.define('zl-feed', Feed);