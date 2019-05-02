import {BaseComponent} from "../framework/base-component.js";
import {UserState} from "../services/user-state.js";

const template = `
<style>

</style>


<h1>Users</h1>
<div id="user-list">

</div>


<div>
    <h2>Letter distribution in usernames</h2>
    <canvas height="400" width="400" id="chart"></canvas>
</div>
`;

export class UserList extends BaseComponent {
    constructor() {
        super(template);
    }

    connectedCallback() {
        super.connectedCallback();

        this.userList = this.shadow.querySelector('#user-list');

        /**
         *
         * @type {HTMLCanvasElement}
         */
        this.canvas = this.shadow.querySelector('#chart');

        this.loadUsers();
    }

    async loadUsers() {
        const users = await UserState.instance.getAllUsers();

        for (const user of users) {
            const p = document.createElement('p');
            p.innerText = user.username;
            this.userList.appendChild(p);
        }

        this.renderChart(users);
    }

    /**
     * Renders the charts
     * @param {Array<{userId: number, username: string}>} users
     */
    renderChart(users) {
        const letters = users.map(user => user.username).join('');

        const counter = new Map();

        for (const letter of letters) {
            let count = counter.get(letter) || 0;
            count++;
            counter.set(letter, count);
        }

        const data = [];
        const labels = [];
        const colors = [];

        for (const [letter, count] of counter) {
            data.push(count);
            labels.push(letter);
            colors.push(this.getColorForLetter(letter));
        }

        const ctx = this.canvas.getContext('2d');

        const pieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: colors,
                    data,
                }],

                labels,
            }
        });

    }

    /**
     * Gets a color for the given letter
     * @param {string} letter
     * @return {string}
     */
    getColorForLetter(letter) {
        const char = letter.charCodeAt(0);

        // Clamp to larger space
        const aCharCode = 'a'.charCodeAt(0);
        const zCharCode = 'z'.charCodeAt(0);

        const diff = char - aCharCode;

        const percent = diff / (zCharCode - aCharCode);

        const hue = Math.round(percent * 255);

        return `hsl(${hue}, 100%, 50%)`;
    }
}

customElements.define('zl-user-list', UserList);