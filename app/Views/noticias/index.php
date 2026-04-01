<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<header class="news-hero">
    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1600&q=80"
         alt="Fundo de Notícias"
         class="news-hero-img"
         fetchpriority="high"
         loading="eager">
    <div class="news-hero-overlay"></div>
    <div class="section-eyebrow news-hero-eyebrow">Conteúdo Jurídico</div>
    <h1 class="hero-title">Artigos & <em>Atualizações</em></h1>
    <p class="hero-sub mx-auto">
        Análise técnica sobre as principais mudanças legislativas e jurisprudenciais do Direito Brasileiro.
    </p>
</header>

<section class="news-list-section">
    <div class="container">

        <!-- Filtros Rápidos -->
        <div class="d-flex justify-content-center gap-3 mb-2 flex-wrap">
            <a href="#" class="btn-ghost">Todos</a>
            <a href="#" class="btn-ghost">Direito Civil</a>
            <a href="#" class="btn-ghost">Administrativo</a>
            <a href="#" class="btn-ghost">Contratos</a>
        </div>
        <div class="row mt-3">
            <!-- Grid de Notícias -->
            <div class="news-grid">
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $article): ?>
                        <article class="news-card reveal">
                            <div class="news-card-content">
                                <h3 class="news-card-title"><?= esc($article['title']) ?></h3>
                                <p class="news-card-excerpt"><?= esc($article['summary']) ?></p>
                                <div class="news-card-footer">
                                    <span class="news-date"><?= date('d/m/Y', strtotime($article['published_at'])) ?></span>
                                    <a href="<?= base_url('noticias/' . $article['slug']) ?>" class="card-tag" aria-label="Ler mais sobre <?= esc($article['title']) ?>">Ler mais</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <p style="color: var(--gray);">Nenhum artigo publicado ainda.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>