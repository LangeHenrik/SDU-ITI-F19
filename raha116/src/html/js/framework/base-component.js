export class BaseComponent extends HTMLElement {
    /**
     * Handlers that needs to be cleaned up, when the component gets detached
     * @type {{[key: string]: Array<function>}}
     */
    _windowListeners = {};

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
        for (const [eventName, callbacks] of this._windowListeners) {
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