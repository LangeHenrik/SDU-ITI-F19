import './components/header.js';
import {BaseComponent} from "./framework/base-component.js";
import {UserState} from "./services/user-state.js";

const template = `<style>
    :host {
        display: grid;

        grid-template-columns: 1fr var(--feed-width) 1fr;
        grid-template-rows: min-content 1fr;

        /* Enforce a certain size of the application */
        width: 100%;
        min-height: 100%;
        background-color: var(--main-background);
    }

    zl-header {
        grid-column: 1 / span 3;
    }

    .body {
        margin: 2rem 0;
        
        grid-column: 2 / span 1;
        
    }
    
    .hidden {
        display: none;
    }

    @media screen and (max-width: 576px) {        
        .sidebar {
            display: none;
        }
        
    }
</style>

<zl-header></zl-header>

<div class="body hidden">
</div>

`;

class Application extends BaseComponent {

    /**
     * Indicates what page we are on, either 'feed' or 'user-list'
     * @type {string}
     */
    currentPage = 'feed';

    constructor() {
        super(template);

        this.body = this.shadow.querySelector('.body');

        this.header = this.shadow.querySelector('zl-header');
    }

    connectedCallback() {
        super.connectedCallback();

        UserState.instance.addEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, () => {
            this._updateAuthentication();
        });

        this.header.addEventListener('feedLink', () => {
            this.currentPage = 'feed';
            this.currentPageChanged();
        });
        this.header.addEventListener('userListLink', () => {
            this.currentPage = 'user-list';
            this.currentPageChanged();
        });

        this.currentPageChanged();
    }

    _updateAuthentication() {
        const authenticated = UserState.instance.isLoggedIn;

        this.body.classList.toggle('hidden', !authenticated);
    }

    async currentPageChanged() {
        // Empty the body
        this.body.innerHTML = '';

        switch (this.currentPage) {
            case 'feed': {
                const {Feed} = await import('./components/feed.js');

                const feed = new Feed();

                this.body.appendChild(feed);

                break;
            }
            case 'user-list': {
                const {UserList} = await import('./components/user-list.js');

                const userList = new UserList();

                this.body.appendChild(userList);

                break;
            }
            default:
                break;
        }
    }
}

customElements.define('zl-application', Application);
