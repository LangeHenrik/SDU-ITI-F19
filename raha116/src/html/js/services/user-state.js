import {get, isSuccess, post} from "./http-client.js";

export class UserState extends EventTarget {

    static IS_LOGGED_IN_CHANGED_EVENT_NAME = 'isLoggedInChanged';

    /**
     * An active instance of user state
     * @type {UserState}
     */
    static instance = new UserState();

    constructor() {
        super();
        this._checkIsLoggedIn();
    }

    _isLoggedIn = false;

    get isLoggedIn() {
        return this._isLoggedIn;
    }

    set isLoggedIn(value) {
        this._isLoggedIn = value;
        console.log('updating isLoggedIn', value);
        this.dispatchEvent(new Event(UserState.IS_LOGGED_IN_CHANGED_EVENT_NAME))
    }

    async _checkIsLoggedIn() {
        const {status, item: {isLoggedIn}} = await get('/api/user/isLoggedIn/');

        if (status !== 200) {
            alert("Something just went horribly wrong, please get support...");
        }

        this.isLoggedIn = isLoggedIn;
    }

    /**
     * Creates a new user with the given username and password
     * @param {string} username
     * @param {string} password
     * @return {Promise<string>}
     */
    async signup(username, password) {
        const res = await post('/api/user/', {username, password});

        if (isSuccess(res)) {
            this.isLoggedIn = true;
            return '';
        }

        return res.item.message;
    }


    async logout() {
        const res = await post('/api/user/logout/');

        if (isSuccess(res)) {
            this.isLoggedIn = false;
            return;
        }

        alert('Logout failed');
    }

    /**
     * Does a login
     * @param {string} username
     * @param {string} password
     */
    async login(username, password) {
        const res = await post('/api/user/login/', {username, password});

        if (isSuccess(res)) {
            this.isLoggedIn = true;
            return '';
        }

        return res.item.message;
    }
}