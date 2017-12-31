const domready = require('domready');

domready(() => {
    document.getElementsByClassName('obfuscated-email').forEach((element) => {
        element.addEventListener('click', function(event) {
            var email = element.dataset.email;
            window.location = 'mailto:' + email;
        })
    })
});