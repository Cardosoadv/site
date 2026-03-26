<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
    <title><?= esc($news['meta_title'] ?: $news['title']) ?> | Cardoso & Bruno</title>
    <meta name="description" content="<?= esc($news['meta_description'] ?: $news['summary']) ?>">
    <meta property="og:title" content="<?= esc($news['meta_title'] ?: $news['title']) ?>">
    <meta property="og:description" content="<?= esc($news['summary']) ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= current_url() ?>">
<?= $this->endSection()?>


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
            <span><i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($news['published_at'])) ?></span>
        </div>
    </header>

    <div class="article-content">
        <?= $news['content'] ?>
    </div>

    <footer class="article-footer mt-5 pt-4 border-top">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="article-share">
                <span class="news-date me-3">Compartilhar:</span>
                <?php 
                    $shareUrl = current_url();
                    $shareTitle = esc($news['title']);
                ?>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= rawurlencode($shareUrl) ?>" 
                   target="_blank" rel="noopener" class="btn btn-outline-dark btn-sm rounded-0" title="Compartilhar no LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text=<?= rawurlencode($shareTitle . ' ' . $shareUrl) ?>" 
                   target="_blank" rel="noopener" class="btn btn-outline-dark btn-sm rounded-0" title="Compartilhar no WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>
            <div class="article-tags">
                <?php if (!empty($news['category_name'])): ?>
                    <span class="badge bg-light text-dark fw-light">#<?= esc($news['category_name']) ?></span>
                <?php endif; ?>
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
                        <span class="news-date"><?= date('d/m/Y', strtotime($rel['published_at'])) ?></span>
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