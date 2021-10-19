document.addEventListener('DOMContentLoaded', function () {
    if (getCookie('error') || getCookie('success')) {
        let message,
            cookieName,
            className;

        if (getCookie('error')) {
            message = getCookie('error');
            cookieName = 'error';
            className = 'danger';
        } else if (getCookie('success')) {
            message = getCookie('success');
            cookieName = 'success';
        }

        showRequestMessage(message, className);
        deleteCookie(cookieName);
    }

});

function setCookie(name, value, options = {}) {
    options = {
        'path': '/',
        'max-age': 60 * 60 * 24,
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    })
}

function clearErrors(fields) {
    for (let i = 0; i < fields.length; i++) {
        let nextSpan = fields[i].nextElementSibling;
        nextSpan.querySelector('strong').innerText = '';
        fields[i].classList.remove('is-invalid');
    }
}

function showErrors(errors) {
    // Показываем ошибки
    let keys = Object.keys(errors);
    for (let i = 0; i < keys.length; i++) {
        let field = document.getElementById(keys[i]);
        let nextSpan = field.nextElementSibling;
        nextSpan.querySelector('strong').innerText = errors[keys[i]][0]; // Первая ошибка в массиве
        field.classList.add('is-invalid');
    }
}

function showRequestMessage(message, className = 'success') {
    if (message === '') return false;

    let messageBlock = document.getElementById('header-messages');

    messageBlock.insertAdjacentHTML('beforebegin', '<div class="alert alert-' + className + ' w-100 text-center alert-dismissible fade show" role="alert">\n' +
        '<span id="header-message"></span>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '<span aria-hidden="true">&times;</span>\n' +
        '</button>\n' +
        '</div>');

    document.getElementById('header-message').innerText = message;

}

