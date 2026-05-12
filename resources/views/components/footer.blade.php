<footer class="site-footer">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <!-- Colonna Info Studio -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Studi Legali Consorziati</h5>
                <p class="footer-text">Consulenza legale specializzata dal 1998. Professionalità, competenza e un approccio personalizzato per ogni cliente.</p>
                
            </div>

            <!-- Colonna Contatti -->
            {{-- <div class="col-lg-4 col-md-12">
                <h5 class="footer-title">Contatti</h5>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> Via Simili n. 14, Catania</li>
                    <li><i class="fas fa-phone"></i> +39 095 530951</li>
                    <li><i class="fas fa-envelope"></i> vallonelegal@gmail.com</li>
                    <li><i class="fas fa-clock"></i> Lun - Ven: 9:00 - 18:00</li>
                </ul>
            </div> --}}

            <!-- Colonna Aree d'intervento -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Aree d'intervento</h5>
                <ul class="footer-links">
                    @foreach($navCategories ?? [] as $category)
                        <li>
                            <a href="{{ route('categories.show', data_get($category, 'slug')) }}">
                                <i class="fas fa-chevron-right"></i> {{ data_get($category, 'name') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="footer-legal">
                <span class="footer-legal__brand">&copy; {{ date('Y') }} Studi Legali Consorziati</span>
                <span class="footer-legal__separator" aria-hidden="true">&mdash;</span>
                <span class="footer-legal__vat">P.IVA 00000000000</span>
                <span class="footer-legal__separator" aria-hidden="true">&mdash;</span>
                <span class="footer-legal__rights">Tutti i diritti sono riservati</span>
            </p>
            <p class="footer-powered">POWERED BY: <a href="https://alessandro-michele-piazza.github.io" target="_blank" rel="noopener noreferrer">Alessandro Michele Piazza</a></p>
        </div>
    </div>
</footer>
