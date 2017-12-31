var elements = document.getElementsByClassName('obfuscated-email');
for (var i in elements) {
    if (Object.prototype.hasOwnProperty.call(elements, i)) {
        var element = elements[i];
        element.addEventListener('click', function(event) {
            var email = element.dataset.email;
            window.location = 'mailto:' + email;
        })
    }
}