@props(['article'])

<article class="article-card">
    <div class="article-card__category">
        <a href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
    </div>
    <h3 class="article-card__title">
        <a href="{{ route('articoli.show', $article) }}">{{ $article->title }}</a>
    </h3>
    <p class="article-card__excerpt">{{ $article->excerpt() }}</p>
    <footer class="article-card__meta">
        <span class="article-card__author">
            <i class="fas fa-user-tie me-1" aria-hidden="true"></i>
            {{ $article->author->name ?? 'Redazione' }}
        </span>
        <time class="article-card__date" datetime="{{ $article->published_at->toDateString() }}">
            <i class="fas fa-calendar-alt me-1" aria-hidden="true"></i>
            {{ $article->published_at->translatedFormat('d M Y') }}
        </time>
        <span class="article-card__reading">
            <i class="fas fa-clock me-1" aria-hidden="true"></i>
            {{ $article->reading_time }} min
        </span>
    </footer>
    <a href="{{ route('articoli.show', $article) }}" class="fold-me-button ">
        Leggi Articolo
    </a>
</article>
