/**
 * Converts the given file into a data url, e.g. for preview
 * @param file
 */
export function getDataUrl(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.addEventListener('load', () => {
            resolve(reader.result);
        });
        reader.addEventListener('error', () => {
            reject(reader.error);
        });
        reader.readAsDataURL(file);
    })
}