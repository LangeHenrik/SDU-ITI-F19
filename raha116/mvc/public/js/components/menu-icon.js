import {BaseComponent} from "../framework/base-component.js";
import {coerceBooleanValue} from "../utilities/types.js";

const template = `
<style>
    .toggle-icon {
        height: 3rem;
        width: 3rem;
    }
    
    .toggle-icon path {
        stroke: var(--main-text-color);
        stroke-width: 3px;
        stroke-linecap: round;
        fill: none;
        transition: d 200ms ease-in-out, stroke-width 200ms ease-in-out;
    }
    
    .toggle-icon path:nth-child(1) {
        d: path('M 5 10 L 20 10 L 35 10');
    }
    .toggle-icon path:nth-child(2) {
        d: path('M 5 20 L 35 20');
    }
    .toggle-icon path:nth-child(3) {
        d: path('M 5 30 L 20 30 L 35 30');
    }
    
    .toggle-icon.open path:nth-child(1) {
        d: path('M 5 5 L 20 20 L 35 5');
    }
    .toggle-icon.open path:nth-child(2) {
        d: path('M 5 20 L 35 20');
        stroke-width: 0px;
    }
    .toggle-icon.open path:nth-child(3) {
        d: path('M 5 35 L 20 20 L 35 35');
    }
</style>

<svg viewBox="0 0 40 40" class="toggle-icon">
    <path></path>
    <path></path>
    <path></path>
</svg>
`;

export class MenuIcon extends BaseComponent {
    constructor() {
        super(template);

        this.toggleIcon = this.shadow.querySelector('.toggle-icon');
    }

    static get observedAttributes() {
        return ['open'];
    }

    get open() {
        return coerceBooleanValue(this.getAttribute('open'));
    }

    set open(open) {
        this.setAttribute('open', open);
    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (name) {
            case 'open':
                const v = coerceBooleanValue(newValue);
                this.toggleIcon.classList.toggle('open', v);
        }
    }

}

customElements.define('zl-menu-icon', MenuIcon);