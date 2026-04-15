@if ($paginator->hasPages())
    <nav id="article-pagination" class="article-pagination" role="navigation" aria-label="Paginazione articoli">
        <ul class="article-pagination__list">
            <li class="article-pagination__item">
                @if ($paginator->onFirstPage())
                    <span class="article-pagination__link article-pagination__link--arrow article-pagination__link--disabled" aria-disabled="true">
                        <i class="fas fa-chevron-left article-pagination__icon" aria-hidden="true"></i>
                    </span>
                @else
                    <a class="article-pagination__link article-pagination__link--arrow"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       aria-label="Pagina precedente">
                        <i class="fas fa-chevron-left article-pagination__icon" aria-hidden="true"></i>
                    </a>
                @endif
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="article-pagination__item">
                        <span class="article-pagination__link article-pagination__link--dots">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="article-pagination__item">
                            @if ($page == $paginator->currentPage())
                                <span class="article-pagination__link article-pagination__link--active" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="article-pagination__link" href="{{ $url }}" aria-label="Vai alla pagina {{ $page }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            <li class="article-pagination__item">
                @if ($paginator->hasMorePages())
                    <a class="article-pagination__link article-pagination__link--arrow"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       aria-label="Pagina successiva">
                        <i class="fas fa-chevron-right article-pagination__icon" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="article-pagination__link article-pagination__link--arrow article-pagination__link--disabled" aria-disabled="true">
                        <i class="fas fa-chevron-right article-pagination__icon" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif