document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('professionals-wrapper');
    const addButton = document.getElementById('add-professional-row');

    if (!wrapper || !addButton) {
        return;
    }

    let nextIndex = wrapper.querySelectorAll('.professional-row').length;

    const updateVisibleIndexes = function () {
        const labels = wrapper.querySelectorAll('.professional-row strong');

        labels.forEach(function (label, index) {
            label.textContent = 'Avvocato #' + String(index + 1);
        });
    };

    const createRow = function (index) {
        const container = document.createElement('div');
        container.className = 'border rounded p-3 professional-row';
        container.setAttribute('data-index', String(index));

        container.innerHTML = '\n            <div class="d-flex justify-content-between align-items-center mb-3">\n                <strong>Avvocato #' + String(index + 1) + '</strong>\n                <button type="button" class="btn btn-sm btn-outline-danger remove-professional-row">Rimuovi</button>\n            </div>\n            <div class="mb-3">\n                <label class="form-label">Nome</label>\n                <input type="text" name="professionals[' + String(index) + '][professional_name]" class="form-control" required>\n            </div>\n            <div class="row g-3 mb-3">\n                <div class="col-md-6">\n                    <label class="form-label">Telefono</label>\n                    <input type="text" name="professionals[' + String(index) + '][phone]" class="form-control" required>\n                </div>\n                <div class="col-md-6">\n                    <label class="form-label">Email</label>\n                    <input type="email" name="professionals[' + String(index) + '][email]" class="form-control" required>\n                </div>\n            </div>\n            <div class="mb-0">\n                <label class="form-label">Sede</label>\n                <input type="text" name="professionals[' + String(index) + '][sede]" class="form-control" required>\n            </div>\n        ';

        return container;
    };

    addButton.addEventListener('click', function () {
        wrapper.appendChild(createRow(nextIndex));
        nextIndex += 1;
        updateVisibleIndexes();
    });

    wrapper.addEventListener('click', function (event) {
        const trigger = event.target;

        if (!trigger.classList.contains('remove-professional-row')) {
            return;
        }

        const rows = wrapper.querySelectorAll('.professional-row');

        if (rows.length <= 1) {
            return;
        }

        const row = trigger.closest('.professional-row');

        if (row) {
            row.remove();
            updateVisibleIndexes();
        }
    });

    updateVisibleIndexes();
});
