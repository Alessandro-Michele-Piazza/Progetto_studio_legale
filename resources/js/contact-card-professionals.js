document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('professionals-wrapper');
    const addButton = document.getElementById('add-professional-row');

    if (!wrapper || !addButton) {
        return;
    }

    const placeholderImage = wrapper.dataset.placeholderImage || '/media/Portrait_Placeholder.webp';
    let nextIndex = wrapper.querySelectorAll('.professional-row').length;

    const updatePreviewFromInput = function (fileInput) {
        const uploadContainer = fileInput.closest('.contact-card-image-upload');
        const preview = uploadContainer ? uploadContainer.querySelector('.contact-card-image-preview') : null;

        if (!preview) {
            return;
        }

        if (preview.dataset.objectUrl) {
            URL.revokeObjectURL(preview.dataset.objectUrl);
            delete preview.dataset.objectUrl;
        }

        const file = fileInput.files && fileInput.files[0] ? fileInput.files[0] : null;

        if (!file) {
            preview.src = placeholderImage;
            return;
        }

        const objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;
        preview.dataset.objectUrl = objectUrl;
    };

    const bindPreviewInput = function (fileInput) {
        if (fileInput.dataset.previewBound === 'true') {
            return;
        }

        fileInput.addEventListener('change', function () {
            updatePreviewFromInput(fileInput);
        });
        fileInput.dataset.previewBound = 'true';
    };

    const bindPreviewInputsIn = function (scope) {
        scope.querySelectorAll('input[type="file"][name*="[profile_image]"]').forEach(function (fileInput) {
            bindPreviewInput(fileInput);
        });
    };

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

        container.innerHTML = '\n            <div class="d-flex justify-content-between align-items-center mb-3">\n                <strong>Avvocato #' + String(index + 1) + '</strong>\n                <button type="button" class="btn btn-sm btn-outline-danger remove-professional-row">Rimuovi</button>\n            </div>\n            <div class="mb-3">\n                <label class="form-label">Nome</label>\n                <input type="text" name="professionals[' + String(index) + '][professional_name]" class="form-control" required>\n            </div>\n            <input type="hidden" name="professionals[' + String(index) + '][existing_profile_image]" value="">\n            <div class="mb-3">\n                <label class="form-label">Foto profilo (opzionale)</label>\n                <div class="contact-card-image-upload">\n                    <img src="' + placeholderImage + '" class="contact-card-image-preview" alt="Anteprima foto profilo">\n                    <input type="file" name="professionals[' + String(index) + '][profile_image]" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">\n                </div>\n            </div>\n            <div class="row g-3 mb-3">\n                <div class="col-md-6">\n                    <label class="form-label">Telefono</label>\n                    <input type="text" name="professionals[' + String(index) + '][phone]" class="form-control" required>\n                </div>\n                <div class="col-md-6">\n                    <label class="form-label">Email</label>\n                    <input type="email" name="professionals[' + String(index) + '][email]" class="form-control" required>\n                </div>\n            </div>\n            <div class="mb-0">\n                <label class="form-label">Sede</label>\n                <input type="text" name="professionals[' + String(index) + '][sede]" class="form-control" required>\n            </div>\n        ';

        return container;
    };

    addButton.addEventListener('click', function () {
        const row = createRow(nextIndex);
        wrapper.appendChild(row);
        bindPreviewInputsIn(row);
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
            row.querySelectorAll('.contact-card-image-preview').forEach(function (preview) {
                if (preview.dataset.objectUrl) {
                    URL.revokeObjectURL(preview.dataset.objectUrl);
                }
            });
            row.remove();
            updateVisibleIndexes();
        }
    });

    bindPreviewInputsIn(wrapper);
    updateVisibleIndexes();
});
