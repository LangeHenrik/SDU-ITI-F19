
export class BaseComponent extends HTMLElement {
    /**
     * Handlers that needs to be cleaned up, when the component gets detached
     * @type {{[key: string]: Array<function>}}
     */
    _windowListeners = {};

    /**
     * The template to use in the component
     * @param template
     */
    constructor(template) {
        super();

        if (!template) {
            throw new Error("No template provided for component");
        }

        /**
         * The shadow root for this component
         * @type {ShadowRoot}
         */
        this.shadow = this.attachShadow({mode: 'open'});

        this.shadow.innerHTML = template;
    }

// This methods are here, so they are easier to overwrite,
    // since they aren't in the definition of HTMLElement
    connectedCallback() {

    }

    disconnectedCallback() {
        this._cleanupWindowHandlers();
    }

    attributeChangedCallback(name, oldValue, newValue) {
    }

    _cleanupWindowHandlers() {
        for (const [eventName, callbacks] of Object.entries(this._windowListeners)) {
            for (const callback of callbacks) {
                window.removeEventListener(eventName, callback);
            }
        }
    }


    /**
     * Registers a handler for the given window event.
     * Use this method instead of manual registration for automatic cleanup
     * @param eventName
     * @param callback
     * @param {AddEventListenerOptions} options
     */
    registerWindowHandler(eventName, callback, options = undefined) {
        const callbacks = this._windowListeners[eventName] || [];
        this._windowListeners = callbacks;

        callbacks.push(callback);

        window.addEventListener(eventName, callback, options);
    }
}