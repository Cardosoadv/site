<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<header class="news-hero">
    <div class="section-eyebrow news-hero-eyebrow">Conteúdo Jurídico</div>
    <h1 class="hero-title" style="font-size: 3.5rem;">Artigos & <em>Atualizações</em></h1>
    <p class="hero-sub mx-auto" style="color: var(--cream-dark);">
        Análise técnica sobre as principais mudanças legislativas e jurisprudenciais do Direito Brasileiro.
    </p>
</header>

<section class="news-list-section">
    <div class="container">

        <!-- Filtros Rápidos -->
        <div class="d-flex justify-content-center gap-3 mb-5 flex-wrap">
            <a href="#" class="btn-ghost" style="padding:0.5rem 1.2rem;font-size:0.65rem;">Todos</a>
            <a href="#" class="btn-ghost" style="padding:0.5rem 1.2rem;font-size:0.65rem;">Direito Civil</a>
            <a href="#" class="btn-ghost" style="padding:0.5rem 1.2rem;font-size:0.65rem;">Administrativo</a>
            <a href="#" class="btn-ghost" style="padding:0.5rem 1.2rem;font-size:0.65rem;">Contratos</a>
        </div>

        <!-- Grid de Notícias -->
        <div class="news-grid">
            <?php if (!empty($news)): ?>
                <?php foreach ($news as $article): ?>
                <article class="news-card reveal">
                    <div class="news-card-content">
                        <h3 class="news-card-title"><?= esc($article['title']) ?></h3>
                        <p class="news-card-excerpt"><?= esc($article['summary']) ?></p>
                        <div class="news-card-footer">
                            <span class="news-date"><?= date('d M, Y', strtotime($article['published_at'])) ?></span>
                            <a href="<?= base_url('noticias/' . $article['slug']) ?>" class="card-tag" style="margin:0;">Ler mais</a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5" style="grid-column: 1 / -1;">
                    <p style="color: var(--gray);">Nenhum artigo publicado ainda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>