    <!-- NAV -->
    <nav class="navbar navbar-expand-lg navbar-dark px-3 px-md-5 w-100" style="background: rgba(13, 27, 42, 0.92); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
        <div class="container-fluid p-0">
            <div class="logo">
                <a class="navbar-brand m-0" href="<?= base_url() ?>">
                    <img src="<?= base_url('public/dist/imgs/logo.png'); ?>"
                            alt="Logo Cardoso & Bruno"
                            style="max-height: 70px; width: auto; object-fit: contain;"
                            fetchpriority="high"
                            loading="eager">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: rgba(201, 168, 76, 0.5);">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end mt-3 mt-lg-0" id="mainNav">
                <ul class="nav-links navbar-nav flex-column flex-lg-row align-items-center mb-3 mb-lg-0 me-lg-4 gap-3 gap-lg-4">
                    <li class="nav-item"><a class="nav-link p-0" href="<?= base_url() ?>#expertise">Áreas de Atuação</a></li>
                    <li class="nav-item"><a class="nav-link p-0" href="<?= base_url() ?>#civil">Direito Civil</a></li>
                    <li class="nav-item"><a class="nav-link p-0" href="<?= base_url() ?>#administrativo">Direito Administrativo</a></li>
                    <li class="nav-item"><a class="nav-link p-0" href="<?= base_url() ?>#contato">Contato</a></li>
                    <li class="nav-item"><a class="nav-link p-0" href="<?= base_url('noticias') ?>">Notícias</a></li>
                </ul>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="<?= base_url() ?>#contato" class="nav-cta border-0 text-decoration-none">Consulta Inicial</a>
                </div>
            </div>
        </div>
    </nav>
