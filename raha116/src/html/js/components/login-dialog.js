import './dialog.js';

const template = `<style>

</style>

<zl-dialog>
<span slot="title">Login</span>

<div slot="body">

In the body now

</div>

</zl-dialog>


`;

export class LoginDialog extends HTMLElement {
    constructor() {
        super();

        const shadow = this.attachShadow({mode: 'open'});

        shadow.innerHTML = template;

        this.dialog = shadow.querySelector('zl-dialog');
    }

    connectedCallback() {
        this.dialog.addEventListener('close', () => {
            this.hide();
        });
    }

    show() {
        document.body.appendChild(this);
    }

    hide() {
        this.remove();
    }
}

customElements.define('zl-login-dialog', LoginDialog);