import './components/header.js';

console.log('application js loaded');

const template = `<style>
    :host {
        display: grid;

        grid-template-columns: 1fr;
        grid-template-rows: min-content 1fr;

        /* Enforce a certain size of the application */
        width: 100vw;
    }

    .body {

    }
</style>

<zl-header></zl-header>

<div class="body">

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
