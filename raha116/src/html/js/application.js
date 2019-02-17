import './components/feed.js';
import './components/header.js';
import {BaseComponent} from "./framework/base-component.js";
import {UserState} from "./services/user-state.js";

console.log('application js loaded');

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
        :host {
            grid-template-columns: 1fr 95vw 1fr;
            
        }
        
        .sidebar {
            display: none;
        }
        
    }
</style>

<zl-header></zl-header>

<div class="body hidden">
    <zl-feed></zl-feed>
</div>

`;

class Application extends BaseComponent {
    constructor() {
        super(template);

        this.body = this.shadow.querySelector('.body');
    }

    connectedCallback() {
        super.connectedCallback();

        UserState.instance.addEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, () => {
            this._updateAuthentication();
        });
    }

    _updateAuthentication() {
        const authenticated = UserState.instance.isLoggedIn;

        this.body.classList.toggle('hidden', !authenticated);
    }


}

customElements.define('zl-application', Application);
