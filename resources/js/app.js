import './bootstrap';
import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bg]').forEach(function (el) {
        el.style.backgroundImage = 'url(' + el.dataset.bg + ')';
    });
});