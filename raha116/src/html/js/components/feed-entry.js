import {BaseComponent} from "../framework/base-component.js";

const template = `
<style></style>
`;

export class FeedEntry extends BaseComponent {
    constructor() {
        super(template);
    }
}

customElements.define('zl-feed-entry', FeedEntry);