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
        headers: {
            'Content-Type': 'application/json'
        },
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
 * Posts form data
 * @param {string} path
 * @param {FormData} data
 * @param progressUpdateCallback - A callback that is invoked whenever the uploaded progresses
 */
export function postFormData(path, data, progressUpdateCallback) {
    return new Promise((resolve, reject) => {

        const request = new XMLHttpRequest();

        request.addEventListener('progress', event => {
            if (event.lengthComputable) {
                progressUpdateCallback({
                    loaded: event.loaded,
                    total: event.total,
                    percent: event.loaded / event.total,
                });
            }
        });

        request.addEventListener('load', event => {
            const res = {
                status: request.status,
                item: JSON.parse(request.responseText),
            };

            resolve(res);
        });

        request.addEventListener('error', event => {
            reject(new Error(request.statusText));
        });

        request.open('POST', path, true);
        request.send(data);
    });
}

/**
 * Checks if the response was a success
 * @param {status: number} res
 * @return {boolean}
 */
export function isSuccess(res) {
    return res.status >= 200 && res.status < 300;
}