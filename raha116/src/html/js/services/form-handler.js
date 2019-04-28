export class FormHandler {
    /**
     * @param {HTMLFormElement} form
     * @param {HTMLElement} fakeSubmitButton - An optional fake submit button
     */
    constructor(form, fakeSubmitButton = undefined) {
        this.form = form;

        this.inputs = this.form.querySelectorAll('input, textarea');

        this._addAllDirtyHandling();

        // Redirect the fakeSubmitButton as a proper submit for the form
        if (fakeSubmitButton) {
            fakeSubmitButton.addEventListener('click', () => {
                form.dispatchEvent(new Event('submit'));
            });
        }
    }

    _addAllDirtyHandling() {
        for (const input of this.inputs) {
            this._addDirtyHandling(input);
        }
    }

    /**
     * Gets the values of the form as an object
     */
    getValues() {
        const out = {};
        for (const input of this.inputs) {
            if (input.type === 'file') {
                out[input.name] = input.multiple ? Array.from(input.files) : input.files[0];
            } else {
                out[input.name] = input.value || '';
            }
        }
        return out;
    }

    /**
     * Resets the entire form
     */
    clear() {
        this.form.reset();

        for (const input of this.inputs) {
            input.classList.remove('dirty');
        }

        this._addAllDirtyHandling();
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