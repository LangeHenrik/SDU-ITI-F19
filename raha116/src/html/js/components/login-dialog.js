import {BaseDialog} from "../framework/base-dialog.js";
import {FormHandler} from "../services/form-handler.js";
import {UserState} from "../services/user-state.js";
import './dialog.js';

const template = `<style>
    @import url('style/forms.css');

    .body {
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }
    
    #login-button {
        flex-basis: 2rem;
    }
    
    .error:not(.hidden) {
        flex-basis: 2rem;
    }
</style>

<zl-dialog>
    <span slot="title">Login</span>

    <form slot="body" class="body form" id="login-form">

        <div class="input-wrapper">
            <label for="username-input">Username</label>
            
            <input class="input" name="username" id="username-input" autofocus required placeholder="Username" maxlength="20">
        </div>
        
        <div class="input-wrapper">
            <label for="password-input">Password</label>
            <input class="input" name="password" id="password-input" type="password" required placeholder="Password" minlength="6">
        </div>
        
        <div class="error hidden" id="general-error"></div>

        <zl-button id="login-button">
            Login
        </zl-button>

        <button type="submit" class="hidden-submit-button"></button>
    </form>

</zl-dialog>
`;

export class LoginDialog extends BaseDialog {
    constructor() {
        super(template);

        this.loginForm = this.shadow.querySelector('#login-form');

        this.loginButton = this.shadow.querySelector('#login-button');

        this.formHandler = new FormHandler(this.loginForm, this.loginButton);

        this.generalError = this.shadow.querySelector('#general-error');
    }

    connectedCallback() {
        super.connectedCallback();

        this.loginForm.addEventListener('submit', event => {
            // Prevent default, as we handle this ourselves
            event.preventDefault();
            this.doLogin();
        });
    }


    async doLogin() {
        const {username, password} = this.formHandler.getValues();

        // If the inputs aren't filled, then we can't really login
        if (!username.trim() || !password.trim()) {
            return;
        }

        this.generalError.classList.add('hidden');

        const responseMessage = await UserState.instance.login(username, password);

        if (responseMessage) {
            this.generalError.classList.remove('hidden');
            this.generalError.innerText = responseMessage;
        } else {
            await this.dialog.close();
        }

    }
}

customElements.define('zl-login-dialog', LoginDialog);