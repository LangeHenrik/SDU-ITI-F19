import './button.js';
import {LoginDialog} from './login-dialog.js';
import './menu-icon.js';

const template = `<style>
    :host {
        display: flex;
        flex-direction: column;
        background-color: var(--main-color);
    }

    .menu-content {
        flex: 0 0 0;
        flex-basis: 0;
        flex-direction: column;
        display: flex;
        transition: flex-basis 200ms ease-in-out;
    }
    
    .menu-content.open {
        flex-basis: 3rem;
    }

    .button {
        flex: 0 0 3rem;
    }
    
    .title {
        color: var(--main-text-color);
        flex: 0 0 3rem;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    
    .title .label {
        padding: 1rem;
        font-size: 1.2rem;
    }
    
    
    #mobile-toggle-button {
        background-color: transparent;
        border: none;
        padding: unset;
        box-sizing: border-box;
        height: 100%;
        padding-right: 3px;
        outline: none !important;
    }
    
    

    @media screen and (min-width: 576px) {
        :host {
            flex-direction: row;
            height: 3rem;
        }
        
        .menu-content {
            flex-direction: row;
            flex: 1 !important;
        }
        
        .filler {
            flex: 1;
        }
        
        .title {
            flex: 0 0 auto;
        }
        
        .button {
            flex: 0 0 7rem;
        }
        
        #mobile-toggle-button {
            display: none;
        }
    }
</style>

<span class="title">
    <span class="label">Totally Not Facebook™</span>
    
    <button id="mobile-toggle-button">
        <zl-menu-icon></zl-menu-icon>
    </button>
</span>


<div class="menu-content">
    <span class="filler"></span>
    
    <zl-button class="button" id="login-button">
        Login
    </zl-button>
    
    <zl-button class="button" id="logout-button">
        Logout
    </zl-button>
</div>
`;

export class Header extends HTMLElement {
    menuOpen = false;

    constructor() {
        super();

        const shadow = this.attachShadow({mode: 'open'});

        shadow.innerHTML = template;

        this.mobileToggleButton = shadow.querySelector('#mobile-toggle-button');

        this.mobileToggleButtonIcon = shadow.querySelector('zl-menu-icon');

        this.menuContent = shadow.querySelector('.menu-content');

        this.loginButton = shadow.querySelector('#login-button');
    }

    connectedCallback() {
        this.mobileToggleButton.addEventListener('click', () => {
            this.menuOpen = !this.menuOpen;
            this.mobileToggleButtonIcon.open = this.menuOpen;
            this.menuContent.classList.toggle('open', this.menuOpen);
        });

        this.loginButton.addEventListener('click', () => {
            this.openLoginDialog();
        })
    }

    openLoginDialog() {
        const dialog = new LoginDialog();
        dialog.show();
    }
}

customElements.define('zl-header', Header);