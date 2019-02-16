import {BaseComponent} from "../framework/base-component.js";
import './button.js';

const template = `<style>
    :host {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 3em min-content 3em;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        filter: drop-shadow(0 0 1rem rgba(0, 0, 0, 0.3));
    }
    
    :host(.opening) {
        animation-name: dialog-appear;
        animation-duration: 250ms;
        animation-timing-function: cubic-bezier(.17,.67,.7,1.50);
    }
    
    :host(.closing) {
        animation-name: dialog-appear;
        animation-duration: 250ms;
        animation-timing-function: cubic-bezier(.17,.67,.7,1.50);
        animation-direction: reverse;
    }

    .header {
        display: grid;
        grid-template-columns: 3em min-content 3em;
        background-color: var(--main-color);
        color: var(--main-text-color);
        place-items: stretch;
    }

    .title {
        justify-content: center;
        align-self: center;
    }

    .footer {

    }
    
    .body {
        background-color: white;
    }

</style>

<div class="header">
    <span><!-- Filler --></span>
    <span class="title">
        <slot name="title"></slot>
    </span>
    <zl-button id="close-dialog-button">X</zl-button>
</div>

<div class="body">
    <slot name="body"></slot>
</div>

<div class="footer">
    <slot name="footer"></slot>
</div>
`;

export class Dialog extends BaseComponent {
    constructor() {
        super();

        const shadow = this.attachShadow({mode: 'open'});

        shadow.innerHTML = template;

        this.closeDialogButton = shadow.querySelector('#close-dialog-button');

        this.handleWindowKeydown = this.handleWindowKeydown.bind(this);
    }

    handleWindowKeydown(event) {
        if (event.defaultPrevented) {
            return;
        }
        event.preventDefault();
        if (event.key === 'Escape') {
            this.close();
        }
        window.removeEventListener('keyup', this.handleWindowKeydown);
    }

    connectedCallback() {
        this.animateOpening();

        this.closeDialogButton.addEventListener('click', () => {
            this.close();
        });

        window.addEventListener('keyup', this.handleWindowKeydown)
    }

    disconnectedCallback() {
        window.removeEventListener('keyup', this.handleWindowKeydown);
    }

    async close() {

        await this.animateClosing();

        this.dispatchEvent(new Event('close', {cancelable: true, bubbles: true}));
    }

    animateOpening() {
        const animation = this.getOpeningAnimation();
        animation.play();
    }

    getOpeningAnimation() {
        const animation = this.animate([{
            transform: 'translate(-50%, -50%) scale(0.5)',
            opacity: '0',
        }, {
            transform: 'translate(-50%, -50%) scale(1)',
            opacity: '1',
        }], {
            duration: 250,
            easing: 'cubic-bezier(.17,.67,.7,1.50)',
        });
        animation.pause();
        return animation;
    }

    animateClosing() {
        const animation = this.getOpeningAnimation();
        animation.reverse();
        return new Promise(resolve => {
            animation.onfinish = resolve;
        });
    }
}

customElements.define('zl-dialog', Dialog);