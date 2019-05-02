import {BaseComponent} from "../framework/base-component.js";
import {ChuckNorrisJokesService} from "../services/chuck-norris-jokes-service.js";
import {FormHandler} from "../services/form-handler.js";
import {FuckAsAServiceService} from "../services/fuck-as-a-service-service.js";

//language=html
const template = `<style>
    @import url('style/forms.css');

    .fucks {
        margin-top: 2em;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .joke {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .joke .header {

    }

    :host {
        display: flex;
        flex-direction: column;
    }

</style>


<div class="joke">
    <h3 class="header">A joke from Chuck Norris</h3>
    <span class="output">Loading...</span>
</div>


<form class="fucks" id="fucksForm">
    <span>Request extra fucks to give</span>
    <div class="input-wrapper">
        <label for="numberOfFucksInput">How many fucks do you want to give?</label>
        <input id="numberOfFucksInput" class="input" type="text" name="numberOfFucks" placeholder="How many fucks do you want to give?">
    </div>
    <zl-button id="fakeFucksToGiveSubmitButton">Request fucks to give</zl-button>
    <span class="output">No fucks given yet</span>
</form>
`;

export class JokeFallback extends BaseComponent {
    constructor() {
        super(template);

        const fucksFormElement = this.shadow.querySelector('#fucksForm');
        const fakeSubmitButton = this.shadow.querySelector('#fakeFucksToGiveSubmitButton');

        this.fucksForm = new FormHandler(fucksFormElement, fakeSubmitButton);

        fucksFormElement.addEventListener('submit', () => {
            const {numberOfFucks} = this.fucksForm.getValues();
            this.loadFucks(numberOfFucks)
        });

        this.fucksOutput = this.shadow.querySelector('.fucks .output');
        this.jokeOutput = this.shadow.querySelector('.joke .output');
    }

    connectedCallback() {
        super.connectedCallback();

        this.loadJoke();
    }

    async loadFucks(numberOfFucks) {
        const service = new FuckAsAServiceService();
        const fucksToGive = await service.getFucks(numberOfFucks);

        if (Array.isArray(fucksToGive)) {
            if (fucksToGive.length === 0) {
                this.fucksOutput.innerText = 'No fucks given then.'
            } else {
                this.fucksOutput.innerText = fucksToGive.join(', ');
            }
        } else {
            this.fucksOutput.innerText = fucksToGive;
        }
    }

    async loadJoke() {
        const service = new ChuckNorrisJokesService();
        const joke = await service.getJokes();

        this.jokeOutput.innerText = joke;
    }
}

customElements.define('zl-joke-fallback', JokeFallback);
