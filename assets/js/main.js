const domready = require('domready');

domready(() => {
    const elements = document.getElementsByClassName('obfuscated-email');
    for (let i in elements) {
        if (Object.prototype.hasOwnProperty.call(elements, i)) {
            const element = elements[i];
            element.addEventListener('click', (event) => {
                const email = element.dataset.email;
                window.location = `mailto:${email}`;
            })
        }
    }
});