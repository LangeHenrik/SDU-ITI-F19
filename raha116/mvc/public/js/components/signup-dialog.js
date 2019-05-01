import '../components/dialog.js';
import {BaseDialog} from "../framework/base-dialog.js";
import {FormHandler} from "../services/form-handler.js";
import {UserState} from "../services/user-state.js";

const template = `<style>
    @import url('style/forms.css');

    .body {
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }

    #signup-button {
        flex-basis: 2rem;
    }


</style>

<zl-dialog>
    <span slot="title">Signup</span>

    <form slot="body" class="body form" id="signup-form">

        <div class="input-wrapper">
            <label for="username-input">Username</label>

            <input class="input" name="username" id="username-input" autofocus required placeholder="Username"
                   maxlength="20">
        </div>


        <div class="input-wrapper">
            <label for="password-input">Password</label>
            <input class="input" name="password" id="password-input" type="password" required placeholder="Password"
                   minlength="6">
        </div>

        <div class="input-wrapper">
            <label for="repeat-password-input">Repeat password</label>
            <input class="input" name="repeatPassword" id="repeat-password-input" type="password" required
                   placeholder="Repeat Password">
            <span class="error hidden" id="repeat-password-error">
                Passwords do not match
            </span>
        </div>


        <div class="input-wrapper">
            <label for="firstname-input">Firstname</label>
            
            <input class="input" name="firstname" id="firstname-input" required placeholder="Firstname" maxlength="20">
        </div>
        
        <div class="input-wrapper">
            <label for="lastname-input">Lastname</label>
            
            <input class="input" name="lastname" id="lastname-input" required placeholder="Lastname" maxlength="20">
        </div>
        
        <div class="input-wrapper">
            <label for="zip-input">Zip</label>
            
            <input class="input" name="zip" id="zip-input" required placeholder="Zip" maxlength="4" type="number">
        </div>
        
        <div class="input-wrapper">
            <label for="city-input">City</label>
            
            <input class="input" name="city" id="city-input" required placeholder="City" maxlength="20">
        </div>
        
        <div class="input-wrapper">
            <label for="email-input">Email</label>
            
            <input class="input" name="email" id="email-input" required placeholder="Email" maxlength="20" type="email">
        </div>
        
        <div class="input-wrapper">
            <label for="phone-input">Phone</label>
            
            <input class="input" name="phone" id="phone-input" required placeholder="Phone" maxlength="20" type="tel">
        </div>
        
        <div class="error hidden" id="general-error"></div>

        <zl-button id="signup-button">
            Signup
        </zl-button>

        <button type="submit" class="hidden-submit-button"></button>
    </form>

</zl-dialog>
`;

export class SignupDialog extends BaseDialog {

    constructor() {
        super(template);

        this.signupForm = this.shadow.querySelector('#signup-form');

        this.signupButton = this.shadow.querySelector('#signup-button');

        this.formHandler = new FormHandler(this.signupForm, this.signupButton);

        this.repeatPasswordError = this.shadow.querySelector('#repeat-password-error');

        this.generalError = this.shadow.querySelector('#general-error');
    }

    connectedCallback() {
        super.connectedCallback();

        this.signupForm.addEventListener('submit', event => {
            console.log('handling signup');
            // Prevent the form from being send to the server
            event.preventDefault();

            this.doSignup();
        })
    }

    async doSignup() {
        const {username, password, repeatPassword, firstname, lastname, zip, city, phone, email} = this.formHandler.getValues();

        if (!username.trim() || password.trim().length < 6 || !repeatPassword.trim() || username.trim().length > 20 || !firstname.trim() || !lastname.trim() || !zip.trim() || !city.trim() || !phone.trim() || !email.trim()) {
            return;
        }

        if (password !== repeatPassword) {
            this.repeatPasswordError.classList.remove('hidden');
        } else {
            this.repeatPasswordError.classList.add('hidden');
        }

        const message = await UserState.instance.signup(username, password, firstname, lastname, zip, city, phone, email);

        if (message) {
            this.generalError.classList.remove('hidden');
            this.generalError.innerText = message;
        } else {
            await this.dialog.close();
        }

    }
}

customElements.define('zl-signup-dialog', SignupDialog);