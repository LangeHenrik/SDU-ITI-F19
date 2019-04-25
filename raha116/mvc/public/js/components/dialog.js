import '../components/button.js';
import {BaseComponent} from "../framework/base-component.js";

const template = `<style>
    
    :host {
        display: grid;
        place-items: center;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
    
    .container {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 3em min-content 3em;
        filter: drop-shadow(0 0 1rem rgba(0, 0, 0, 0.3));
    }
    
    .background {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .header {
        display: grid;
        grid-template-columns: 3em auto 3em;
        background-color: var(--main-color);
        color: var(--main-text-color);
        place-items: stretch;
    }

    .title {
        justify-self: center;
        align-self: center;
    }

    .footer {

    }

    .body {
        background-color: white;
    }

</style>

<div class="background">
    
</div>

<div class="container">

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

</div>

`;

export class Dialog extends BaseComponent {
    constructor() {
        super(template);

        this.closeDialogButton = this.shadow.querySelector('#close-dialog-button');

        this.handleWindowKeydown = this.handleWindowKeydown.bind(this);

        this.container = this.shadow.querySelector('.container');

        this.background = this.shadow.querySelector('.background');
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

        window.addEventListener('keyup', this.handleWindowKeydown);

        this.background.addEventListener('click', event => {
            if (event.defaultPrevented) {
                return;
            }
            event.preventDefault();
            this.close();
        })
    }

    disconnectedCallback() {
        window.removeEventListener('keyup', this.handleWindowKeydown);
    }

    async close() {

        await this.animateClosing();

        this.dispatchEvent(new Event('close', {cancelable: true, bubbles: true}));
    }

    animateOpening() {
        const containerAnimation = this.getOpeningAnimation();
        containerAnimation.play();
        const backgroundAnimation = this.getBackgroundOpeningAnimation();
        backgroundAnimation.play();
    }

    getOpeningAnimation() {
        const animation = this.container.animate([{
            transform: 'scale(0.5)',
            opacity: '0',
        }, {
            transform: 'scale(1)',
            opacity: '1',
        }], {
            duration: 250,
            easing: 'cubic-bezier(.17,.67,.7,1.50)',
        });
        animation.pause();
        return animation;
    }

    getBackgroundOpeningAnimation() {
        const animation = this.background.animate([
            {opacity: '0'},
            {opacity: '1'}
        ], {duration: 250, easing: 'ease-in-out'});
        animation.pause();
        return animation;
    }

    animateClosing() {
        const containerAnimation = this.getOpeningAnimation();
        containerAnimation.reverse();

        const backgroundAnimation = this.getBackgroundOpeningAnimation();
        backgroundAnimation.reverse();

        return new Promise(resolve => {
            containerAnimation.onfinish = resolve;
        });
    }
}

customElements.define('zl-dialog', Dialog);