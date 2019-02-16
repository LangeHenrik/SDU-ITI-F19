import './components/button.js'

console.log('application js loaded');

const template = `<style>
    :host {
        display: grid;

        grid-template-columns: 1fr;
        grid-template-rows: 3em auto;

        /* Enforce a certain size of the application */
        height: 100vh;
        max-height: 100vh;
        min-height: 100vh;
        width: 100vw;
        max-width: 100vw;
        min-width: 100vw;
    }

    .header {
        background-color: var(--main-color);
        display: flex;
        flex-direction: row;
    }
    
    .header .filler {
        flex: 1;
    }
    
    .header .end {
        flex-basis: 7em;
    }

    .body {

    }
</style>
<div class="header">
    <span class="filler"></span>
    
    <zl-button class="end" id="login-button">
        Login
    </zl-button>
    
    <zl-button class="end" id="logout-button">
        Logout
    </zl-button>
</div>

<div class="body">

</div>
`;

class Application extends HTMLElement {

    constructor() {
        super();

        // Clear the loading text
        this.innerHTML = '';

        const shadow = this.attachShadow({mode: "open"});

        shadow.innerHTML = template;

        this.loginButton = shadow.querySelector('#login-button');

        this.loginButton.addEventListener('click', () => {
            this.showLoginDialog();
        });

        this.logoutButton = shadow.querySelector('#logout-button');

        this.logoutButton.addEventListener('click', () => {
            this.logout();
        })
    }

    showLoginDialog() {
        console.log('showing login dialog');
    }

    logout() {
        console.log('logging out');
    }
}

customElements.define("zl-application", Application);
