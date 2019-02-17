import {BaseComponent} from "../framework/base-component.js";
import './feed-creator.js';
import './feed-entry.js';

const template = `<style>
    
</style>

<zl-feed-creator></zl-feed-creator>

<div class="feed-list">
    
</div>
`;

export class Feed extends BaseComponent {
    constructor() {
        super(template);
    }


}

customElements.define('zl-feed', Feed);