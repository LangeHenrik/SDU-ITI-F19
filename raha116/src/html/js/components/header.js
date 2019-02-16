import {BaseComponent} from "../framework/base-component.js";
import {UserState} from "../services/user-state.js";
import './button.js';
import {LoginDialog} from './login-dialog.js';
import './menu-icon.js';
import {SignupDialog} from "./signup-dialog.js";

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
    
    .hidden {
        display: none;
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
    
    <zl-button class="button hidden" id="login-button">
        Login
    </zl-button>
    
    <zl-button class="button hidden" id="signup-button">
        Sign up
    </zl-button>
    
    <zl-button class="button hidden" id="logout-button">
        Logout
    </zl-button>
</div>
`;

export class Header extends BaseComponent {
    menuOpen = false;

    constructor() {
        super(template);

        this.updateAuthenticationButtons = this.updateAuthenticationButtons.bind(this);

        this.mobileToggleButton = this.shadow.querySelector('#mobile-toggle-button');

        this.mobileToggleButtonIcon = this.shadow.querySelector('zl-menu-icon');

        this.menuContent = this.shadow.querySelector('.menu-content');

        this.loginButton = this.shadow.querySelector('#login-button');

        this.logoutButton = this.shadow.querySelector('#logout-button');

        this.signupButton = this.shadow.querySelector('#signup-button');
    }

    connectedCallback() {
        this.mobileToggleButton.addEventListener('click', () => {
            this.menuOpen = !this.menuOpen;
            this.mobileToggleButtonIcon.open = this.menuOpen;
            this.menuContent.classList.toggle('open', this.menuOpen);
        });

        this.loginButton.addEventListener('click', () => {
            this.openLoginDialog();
        });

        this.signupButton.addEventListener('click', () => {
            this.openSignupDialog();
        });

        this.logoutButton.addEventListener('click', () => {
            UserState.instance.logout();
        });

        UserState.instance.addEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, this.updateAuthenticationButtons);
    }


    disconnectedCallback() {
        super.disconnectedCallback();

        UserState.instance.removeEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, this.updateAuthenticationButtons);
    }

    updateAuthenticationButtons() {
        const isLoggedIn = UserState.instance.isLoggedIn;

        this.loginButton.classList.toggle('hidden', isLoggedIn);
        this.signupButton.classList.toggle('hidden', isLoggedIn);
        this.logoutButton.classList.toggle('hidden', !isLoggedIn);
    }

    openLoginDialog() {
        const dialog = new LoginDialog();
        dialog.show();
    }

    openSignupDialog() {
        const dialog = new SignupDialog();
        dialog.show();
    }
}

customElements.define('zl-header', Header);