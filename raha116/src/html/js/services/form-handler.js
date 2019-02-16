export class FormHandler {
    /**
     * @param {HTMLFormElement} form
     * @param {HTMLElement} fakeSubmitButton - An optional fake submit button
     */
    constructor(form, fakeSubmitButton = undefined) {
        this.inputs = form.querySelectorAll('input');

        for (const input of this.inputs) {
            this._addDirtyHandling(input);
        }

        // Redirect the fakeSubmitButton as a proper submit for the form
        if (fakeSubmitButton) {
            fakeSubmitButton.addEventListener('click', () => {
                form.dispatchEvent(new Event('submit'));
            });
        }
    }

    /**
     * Gets the values of the form as an object
     */
    getValues() {
        const out = {};
        for (const input of this.inputs) {
            out[input.name] = input.value || '';
        }
        return out;
    }


    /**
     * Adds handling around dirty inputs
     * @param {HTMLInputElement} input
     */
    _addDirtyHandling(input) {
        input.addEventListener('input', () => {
            input.classList.add('dirty');
        }, {once: true});
    }
}