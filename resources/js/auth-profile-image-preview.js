document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profile_image');
    const preview = document.getElementById('profile-image-preview');

    if (!fileInput || !preview) {
        return;
    }

    const placeholderImage = fileInput.dataset.placeholderImage || '/media/Portrait_Placeholder.webp';

    const clearObjectUrl = function () {
        if (preview.dataset.objectUrl) {
            URL.revokeObjectURL(preview.dataset.objectUrl);
            delete preview.dataset.objectUrl;
        }
    };

    const restorePlaceholder = function () {
        clearObjectUrl();
        preview.src = placeholderImage;
    };

    fileInput.addEventListener('change', function () {
        const file = fileInput.files && fileInput.files[0] ? fileInput.files[0] : null;

        if (!file) {
            restorePlaceholder();
            return;
        }

        clearObjectUrl();

        const objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;
        preview.dataset.objectUrl = objectUrl;
    });

    window.addEventListener('beforeunload', function () {
        clearObjectUrl();
    });
});
