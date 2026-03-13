<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<div class="news-hero" style="height: 400px; padding-top: 8rem;">
    <div class="container">
        <a href="<?= base_url('noticias') ?>" class="article-tag" style="text-decoration: none; border: 1px solid var(--gold); padding: 5px 15px; color: var(--gold);">
            &larr; Voltar para a listagem
        </a>
    </div>
</div>

<article class="article-container">
    <header class="article-header">
        <h1 class="article-title"><?= esc($news['title']) ?></h1>

        <div class="article-meta">
            <span><i class="bi bi-calendar3"></i> <?= date('d \de F \de Y', strtotime($news['published_at'])) ?></span>
        </div>
    </header>

    <div class="article-content">
        <?= $news['content'] ?>
    </div>

    <footer class="article-footer mt-5 pt-4 border-top">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="article-share">
                <span class="news-date me-3">Compartilhar:</span>
                <a href="#" class="btn btn-outline-dark btn-sm rounded-0"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="btn btn-outline-dark btn-sm rounded-0"><i class="bi bi-whatsapp"></i></a>
            </div>
            <div class="article-tags">
                <span class="badge bg-light text-dark fw-light">#AdvocaciaColaborativa</span>
                <span class="badge bg-light text-dark fw-light">#DireitoDeFamilia</span>
            </div>
        </div>
    </footer>
</article>

<!-- Seção de Relacionados -->
<section class="container mb-5">
    <h4 class="font-serif mb-4" style="font-family:'Cormorant Garamond'; color: var(--navy); font-size: 2rem;">Leia também</h4>
    <div class="row g-4">
        <?php if (!empty($related)): ?>
            <?php foreach ($related as $rel): ?>
            <div class="col-md-4">
                <div class="news-card">
                    <div class="news-card-content">
                        <span class="news-date"><?= date('d M Y', strtotime($rel['published_at'])) ?></span>
                        <h5 class="news-card-title" style="font-size: 1.1rem;"><?= esc($rel['title']) ?></h5>
                        <a href="<?= base_url('noticias/' . $rel['slug']) ?>" class="card-tag">Ler artigo</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>