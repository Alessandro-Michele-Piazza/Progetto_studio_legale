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
                    <div class="article-single__body" itemprop="articleBody">
                        {!! $article->body !!}
                    </div>

                    <!-- Condivisione social -->
                    <aside class="article-share" aria-label="Condividi l'articolo">
                        <span class="article-share__label">Condividi:</span>
                        <div class="article-share__buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                rel="noopener noreferrer" class="article-share__btn article-share__btn--facebook"
                                aria-label="Condividi su Facebook">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="article-share__btn article-share__btn--whatsapp"
                                aria-label="Condividi su WhatsApp">
                                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                            </a>
                            <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank"
                                rel="noopener noreferrer" class="article-share__btn article-share__btn--telegram"
                                aria-label="Condividi su Telegram">
                                <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="article-share__btn article-share__btn--linkedin"
                                aria-label="Condividi su LinkedIn">
                                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                            </a>
                            <a href="mailto:?subject={{ $shareTitle }}&body={{ $shareUrl }}"
                                class="article-share__btn article-share__btn--email" aria-label="Condividi via Email">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                            </a>
                        </div>
                    </aside>

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