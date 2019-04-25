import {BaseComponent} from "../framework/base-component.js";
import {UserState} from "../services/user-state.js";

const template = `
<style>

</style>

<div id="user-list">


</div>
`;

export class UserList extends BaseComponent {
    constructor() {
        super(template);
    }

    connectedCallback() {
        super.connectedCallback();

        this.userList = this.shadow.querySelector('#user-list');

        this.loadUsers();
    }

    async loadUsers() {
        const users = await UserState.instance.getAllUsers();

        for (const user of users) {
            const p = document.createElement('p');
            p.innerText = user.username;
            this.userList.appendChild(p);
        }

    }
}

customElements.define('zl-user-list', UserList);