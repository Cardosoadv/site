<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<header class="news-hero">
    <div class="section-eyebrow justify-content-center" style="color: var(--gold);">Conteúdo Jurídico</div>
    <h1 class="hero-title" style="font-size: 3.5rem;">Artigos & <em>Atualizações</em></h1>
    <p class="hero-sub mx-auto" style="color: var(--cream-dark);">
        Análise técnica sobre as principais mudanças legislativas e jurisprudenciais do Direito Brasileiro.
    </p>
</header>

<section class="news-list-section">
    <div class="container">
        <!-- Filtros Rápidos (Opcional) -->
        <div class="d-flex justify-content-center gap-3 mb-5 flex-wrap">
            <a href="#" class="btn-ghost" style="padding: 0.5rem 1.2rem; font-size: 0.65rem;">Todos</a>
            <a href="#" class="btn-ghost" style="padding: 0.5rem 1.2rem; font-size: 0.65rem;">Direito Civil</a>
            <a href="#" class="btn-ghost" style="padding: 0.5rem 1.2rem; font-size: 0.65rem;">Administrativo</a>
            <a href="#" class="btn-ghost" style="padding: 0.5rem 1.2rem; font-size: 0.65rem;">Contratos</a>
        </div>

        <div class="news-grid">
            <!-- Os cards seriam gerados via loop do Controller -->
            <?php for($i=1; $i<=6; $i++): ?>
            <article class="news-card reveal">
                <div class="news-card-img">
                    <div class="news-tag">Especialidade</div>
                    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=600&q=80" alt="Notícia">
                </div>
                <div class="news-card-content">
                    <h3 class="news-card-title">Tendências do Contencioso Administrativo em 2026</h3>
                    <p class="news-card-excerpt">
                        Uma análise profunda sobre como as novas tecnologias estão moldando a relação entre o Estado e os particulares no âmbito judicial.
                    </p>
                    <div class="news-card-footer">
                        <span class="news-date">08 Mar, 2026</span>
                        <a href="<?= base_url('noticias/show/exemplo') ?>" class="card-tag" style="margin:0;">Ler mais</a>
                    </div>
                </div>
            </article>
            <?php endfor; ?>
        </div>

        <!-- Paginação customizada -->
        <div class="mt-5 d-flex justify-content-center">
            <nav aria-label="Navegação de notícias">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<?= $this->endSection() ?>