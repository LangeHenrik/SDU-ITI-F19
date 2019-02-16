/**
 * Sends a get request
 * @template T
 * @param path
 * @return {Promise<{status: number, item: T}>}
 */
export async function get(path) {

    const res = await fetch(path);

    const item = await res.json();

    return {
        status: res.status,
        item,
    };
}

/**
 * Sends a post request
 * @template T
 * @param path
 * @param body
 * @return {Promise<{status: number, item: T}>}
 */
export async function post(path, body = null) {
    const res = await fetch(path, {
        method: 'POST',
        body: body ? JSON.stringify(body) : '',
    });

    let item = null;
    if (res.status !== 204) {
        item = await res.json();
    }

    return {
        status: res.status,
        item,
    };
}

/**
 * Checks if the response was a success
 * @param {status: number} res
 * @return {boolean}
 */
export function isSuccess(res) {
    return res.status >= 200 && res.status < 300;
}