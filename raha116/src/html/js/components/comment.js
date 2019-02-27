import {BaseComponent} from "../framework/base-component.js";
import {coerceBooleanValue} from "../utilities/types.js";

const template = `
<style>
    
    :host {
        margin: 1rem 4rem 1rem 1rem;
        
        border: 2px solid var(--main-color);
        border-radius: 3px;
        display: block;
        padding: 0.2rem;
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

        this._onUserIdChanged();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (name) {
            case 'user-id':
                this._onUserIdChanged();
                break;
        }
    }

    _onUserIdChanged() {
        this.classList.toggle('by-this-user', this.byThisUser)
    }
}

customElements.define('zl-comment', Comment);