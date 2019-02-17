import './components/feed.js';
import './components/header.js';

console.log('application js loaded');

const template = `<style>
    :host {
        display: grid;

        grid-template-columns: 1fr var(--feed-width) 1fr;
        grid-template-rows: min-content 1fr;

        /* Enforce a certain size of the application */
        width: 100%;
        background-color: var(--main-background);
    }

    zl-header {
        grid-column: 1 / span 3;
    }

    .body {
        margin: 2rem 0 0 0;
        
        grid-column: 2 / span 1;
        
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

<div class="body">
    <zl-feed></zl-feed>
</div>

`;

class Application extends HTMLElement {
    constructor() {
        super();

        // Clear the loading text
        this.innerHTML = '';

        const shadow = this.attachShadow({mode: 'open'});

        shadow.innerHTML = template;
    }
}

customElements.define('zl-application', Application);
