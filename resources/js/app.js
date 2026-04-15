import './bootstrap';
import 'bootstrap';
import './bottone.js';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bg]').forEach(function (el) {
        el.style.backgroundImage = 'url(' + el.dataset.bg + ')';
    });
});