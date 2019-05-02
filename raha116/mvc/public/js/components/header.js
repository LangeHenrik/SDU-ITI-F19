import '../components/button.js';
import {BaseComponent} from "../framework/base-component.js";
import {UserState} from "../services/user-state.js";
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
        flex-direction: column;
        display: flex;
        overflow: hidden;
    }
    
    .menu-content.open {
        flex-basis: auto;
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

    <zl-button class="button hidden" id="feed-link">
        Feed
    </zl-button>

    <zl-button class="button hidden" id="user-list-link">
        Users
    </zl-button>

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
    previousMenuAnimation = null;

    constructor() {
        super(template);

        this.updateAuthenticationButtons = this.updateAuthenticationButtons.bind(this);

        this.mobileToggleButton = this.shadow.querySelector('#mobile-toggle-button');

        this.mobileToggleButtonIcon = this.shadow.querySelector('zl-menu-icon');

        this.menuContent = this.shadow.querySelector('.menu-content');

        this.loginButton = this.shadow.querySelector('#login-button');

        this.logoutButton = this.shadow.querySelector('#logout-button');

        this.signupButton = this.shadow.querySelector('#signup-button');
        this.feedLinkButton = this.shadow.querySelector('#feed-link');
        this.userListLinkButton = this.shadow.querySelector('#user-list-link');
    }

    connectedCallback() {
        this.mobileToggleButton.addEventListener('click', () => {
            this.toggleMenu();
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

        this.feedLinkButton.addEventListener('click', () => {
            this.dispatchEvent(new CustomEvent('feedLink'))
        });

        this.userListLinkButton.addEventListener('click', () => {
            this.dispatchEvent(new CustomEvent('userListLink'))
        });

        UserState.instance.addEventListener(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME, this.updateAuthenticationButtons);
    }

    toggleMenu() {
        this.menuOpen = !this.menuOpen;
        this.mobileToggleButtonIcon.open = this.menuOpen;
        // this.menuContent.classList.toggle('open', this.menuOpen);

        if (this.menuOpen) {
            this.animateMenuOpen();
        } else {
            this.animateMenuClosed();
        }
    }

    animateMenuOpen() {
        const currentHeight = this.menuContent.offsetHeight;
        this.menuContent.style.flexBasis = 'auto';
        const maxHeight = this.menuContent.offsetHeight;
        this.menuContent.style.flexBasis = '';

        this.animateMenu([
            {flexBasis: `${currentHeight}px`},
            {flexBasis: `${maxHeight}px`}
        ]);
    }

    async animateMenu(keyframes) {
        if (this.previousMenuAnimation) {
            this.previousMenuAnimation.cancel();
        }

        this.previousMenuAnimation = this.menuContent.animate(keyframes, {
            duration: 200,
            easing: 'ease-in-out',
        });

        await this.previousMenuAnimation.finished;

        this.menuContent.classList.toggle('open', this.menuOpen);

    }

    animateMenuClosed() {
        const currentHeight = this.menuContent.offsetHeight;

        this.animateMenu([
            {flexBasis: `${currentHeight}px`},
            {flexBasis: `0px`}
        ]);
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
        this.userListLinkButton.classList.toggle('hidden', !isLoggedIn);
        this.feedLinkButton.classList.toggle('hidden', !isLoggedIn);
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