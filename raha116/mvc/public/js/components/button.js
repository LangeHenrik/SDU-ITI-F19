import {BaseComponent} from "../framework/base-component.js";

const template = `<style>
    :host {
        background-color: var(--main-color);
        color: var(--main-text-color);
        padding: 0.3rem;
        cursor: pointer;
        display: grid;
        justify-items: center;
        align-content: center;
        transition: background-color 150ms ease-in-out;
        text-transform: uppercase;
        box-sizing: border-box;
    }
    
    :host(:hover) {
        background-color: var(--hovered-main-color);
    }
</style>

<slot></slot>
`;

export class Button extends BaseComponent {
    constructor() {
        super(template);
    }
}

customElements.define('zl-button', Button);
