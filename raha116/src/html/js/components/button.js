const template = `<style>
    :host {
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

export class Button extends HTMLElement {
    constructor() {
        super();

        const shadow = this.attachShadow({mode: 'open'});

        shadow.innerHTML = template;
    }
}

customElements.define('zl-button', Button);
