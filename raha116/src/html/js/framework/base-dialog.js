import {Dialog} from "../components/dialog.js";
import {BaseComponent} from "./base-component.js";

export class BaseDialog extends BaseComponent {
    constructor(template) {
        super(template);

        /**
         * A reference to the dialog in the template
         * @type {Dialog}
         */
        this.dialog = this.shadow.querySelector('zl-dialog')
    }

    connectedCallback() {
        super.connectedCallback();

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