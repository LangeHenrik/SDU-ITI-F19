/**
 * Converts the given string into a boolean
 * @param {string|boolean|number} b
 * @return {boolean}
 */
export function coerceBooleanValue(b) {
    if (b === 'true' || b === true || b === 1 || b === '1') {
        return true;
    }
    return false;
}