@php
    $shareUrl = urlencode(route('articoli.show', $article));
    $shareTitle = urlencode($article->title);
@endphp

<x-layout :title="$article->title . ' | Studi Legali Consorziati'" :description="$article->excerpt(160)"
    ogType="article" :ogTitle="$article->title" :ogDescription="$article->excerpt(160)" :ogUrl="route('articoli.show', $article)">

    <article class="article-single" itemscope itemtype="https://schema.org/Article">
        <header class="article-single__header">
            <div class="container">
                <nav class="article-single__breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('articoli.index') }}">Articoli</a>
                    <span aria-hidden="true">/</span>
                    <a href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
                    <span aria-hidden="true">/</span>
                    <span aria-current="page">{{ \Illuminate\Support\Str::limit($article->title, 40) }}</span>
                </nav>

                <div class="article-single__category">
                    <a href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
                </div>

                <h1 class="article-single__title" itemprop="headline">{{ $article->title }}</h1>

                <div class="article-single__meta">
                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <i class="fas fa-user-tie me-1" aria-hidden="true"></i>
                        <span itemprop="name">{{ $article->author->name ?? 'Redazione' }}</span>
                    </span>
                    <time datetime="{{ $article->published_at?->toDateString() }}" itemprop="datePublished">
                        <i class="fas fa-calendar-alt me-1" aria-hidden="true"></i>
                        {{ $article->published_at?->translatedFormat('d F Y') }}
                    </time>
                    <span>
                        <i class="fas fa-clock me-1" aria-hidden="true"></i>
                        {{ $article->reading_time }} min di lettura
                    </span>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="article-single__body mb-5" itemprop="articleBody">
                        {!! $article->body !!}
                    </div>



                    @auth
                        <div class="article-single__admin">
                            <a href="{{ route('articoli.edit', $article) }}" class="btn-site">
                                <i class="fas fa-edit me-1" aria-hidden="true"></i>Modifica
                            </a>
                            <form action="{{ route('articoli.destroy', $article) }}" method="POST"
                                onsubmit="return confirm('Eliminare definitivamente questo articolo?')">
                                @csrf
                                @method('DELETE')
                                <button class="delete_button"><span class="text">Cancella</span>
                                    <span class="icon">
                                        <i class="fas fa-trash-alt text-white" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </article>

</x-layout>