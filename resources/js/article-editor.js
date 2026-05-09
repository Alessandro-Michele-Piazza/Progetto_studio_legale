document.addEventListener('DOMContentLoaded', function () {
    const bodyField = document.querySelector('[data-article-editor]');

    if (!bodyField || typeof CKEDITOR === 'undefined') {
        return;
    }

    const {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Underline,
        Link,
        BlockQuote,
        List,
        Heading,
        Undo,
    } = CKEDITOR;

    ClassicEditor.create(bodyField, {
        licenseKey: 'GPL',
        language: 'it',
        plugins: [
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Underline,
            Link,
            BlockQuote,
            List,
            Heading,
            Undo,
        ],
        toolbar: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            '|',
            'link',
            'blockQuote',
            '|',
            'bulletedList',
            'numberedList',
            '|',
            'undo',
            'redo',
        ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragrafo', class: 'ck-heading_paragraph' },
                { model: 'heading2', view: 'h2', title: 'Titolo 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Titolo 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Titolo 4', class: 'ck-heading_heading4' },
            ],
        },
    }).catch(function (error) {
        console.error(error);
    });
});
