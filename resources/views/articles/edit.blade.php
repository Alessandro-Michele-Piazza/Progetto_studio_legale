<x-layout
    title="Modifica Articolo | Studi Legali Consorziati"
    description=""
    robots="noindex, nofollow"
>

    <section class="article-form-section" aria-label="Modifica articolo">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="article-editor__panel">
                        <span class="section-label">
                            <i class="fas fa-edit me-2" aria-hidden="true"></i>Modifica
                        </span>
                        <h1 class="section-title">Modifica Articolo</h1>
                        <div class="section-divider"></div>

                        @if($errors->any())
                            <div class="article-editor__alert" role="alert">
                                <p class="article-editor__alert-title">
                                    <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                    Correggi i seguenti errori:
                                </p>
                                <ul class="article-editor__alert-list">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('articoli.update', $article) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="title" class="article-editor__label">Titolo</label>
                                    <input type="text"
                                           class="article-editor__control article-editor__control--title @error('title') article-editor__control--error @enderror"
                                           id="title" name="title" value="{{ old('title', $article->title) }}"
                                           placeholder="Titolo dell'articolo" required>
                                    @error('title')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="category_id" class="article-editor__label">Categoria</label>
                                    <div class="article-editor__select-wrap">
                                        <select class="article-editor__control @error('category_id') article-editor__control--error @enderror"
                                                id="category_id" name="category_id" required>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 d-flex align-items-end">
                                    @if($article->published_at)
                                        <p class="article-editor__status mb-0">
                                            <i class="fas fa-check-circle me-1" aria-hidden="true"></i>
                                            Pubblicato il {{ $article->published_at->translatedFormat('d F Y') }}
                                        </p>
                                    @else
                                        <div class="article-editor__publish-row">
                                            <input type="checkbox"
                                                   class="article-editor__checkbox"
                                                   id="publish" name="publish" value="1"
                                                   {{ old('publish') ? 'checked' : '' }}>
                                            <label class="article-editor__label article-editor__label--inline mb-0" for="publish">
                                                Pubblica ora
                                            </label>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label for="body" class="article-editor__label">Contenuto</label>
                                    <textarea class="article-editor__control article-editor__control--textarea @error('body') article-editor__control--error @enderror"
                                              id="body" name="body" rows="15">{{ old('body', $article->body) }}</textarea>
                                    @error('body')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-site article-editor__submit">
                                        <i class="fas fa-save me-2" aria-hidden="true"></i>
                                        Salva Modifiche
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
        <script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const {
                    ClassicEditor, Essentials, Paragraph, Bold, Italic, Underline,
                    Link, BlockQuote, List, Heading, Undo
                } = CKEDITOR;

                ClassicEditor
                    .create(document.querySelector('#body'), {
                        licenseKey: 'GPL',
                        language: 'it',
                        plugins: [
                            Essentials, Paragraph, Bold, Italic, Underline,
                            Link, BlockQuote, List, Heading, Undo
                        ],
                        toolbar: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'link', 'blockQuote', '|',
                            'bulletedList', 'numberedList', '|',
                            'undo', 'redo'
                        ],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragrafo', class: 'ck-heading_paragraph' },
                                { model: 'heading2', view: 'h2', title: 'Titolo 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Titolo 3', class: 'ck-heading_heading3' },
                                { model: 'heading4', view: 'h4', title: 'Titolo 4', class: 'ck-heading_heading4' }
                            ]
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        </script>
    @endpush

</x-layout>
