import {BaseComponent} from "../framework/base-component.js";
import {coerceBooleanValue} from "../utilities/types.js";

const template = `
<style>
    
    :host {
        margin-right: 4rem;
        margin-left: 1rem;
        
        border: 2px solid var(--main-color);
        border-radius: 3px;
        display: block;
        padding: 0.2rem;
        box-sizing: border-box;
        background-color: white;
    }
    
    :host(.by-this-user) {
        margin-right: 1rem;
        margin-left: 4rem;
    }
    
</style>

<slot></slot>


`;

export class Comment extends BaseComponent {

    constructor() {
        super(template);
    }

    static get observedAttributes() {
        return ['by-this-user'];
    }

    get byThisUser() {
        return coerceBooleanValue(this.getAttribute('by-this-user'));
    }

    set byThisUser(value) {
        this.setAttribute('by-this-user', value);
    }

    connectedCallback() {
        super.connectedCallback();

        this._onByThisUserChanged();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (name) {
            case 'by-this-user':
                this._onByThisUserChanged();
                break;
        }
    }

    _onByThisUserChanged() {
        this.classList.toggle('by-this-user', this.byThisUser)
    }
}

customElements.define('zl-comment', Comment);