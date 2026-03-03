<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<section class="news-list-section">
    <div class="news-header">
        <h1 class="news-main-title">Notícias e Artigos</h1>
        <div class="gold-line"></div>
        <p class="news-subtitle">Acompanhe as últimas novidades, artigos jurídicos e atualizações do nosso escritório.</p>
    </div>

    <div class="news-grid">
        <!-- Exemplo de Card de Notícia 1 -->
        <article class="news-card">
            <div class="news-card-img">
                <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=600&q=80" alt="Resumo da notícia">
            </div>
            <div class="news-card-content">
                <span class="news-tag">Direito Civil</span>
                <h3 class="news-card-title">Nova legislação sobre contratos digitais entra em vigor</h3>
                <p class="news-card-excerpt">Entenda como as recentes mudanças afetam a validade de assinaturas eletrônicas e a elaboração de contratos no meio digital...</p>
                <div class="news-card-footer">
                    <span class="news-date">10 de Outubro, 2023</span>
                    <a href="<?= base_url('noticias/show/nova-legislacao-contratos') ?>" class="news-read-more">Ler artigo &rarr;</a>
                </div>
            </div>
        </article>

        <!-- Exemplo de Card de Notícia 2 -->
        <article class="news-card">
            <div class="news-card-img">
                <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=600&q=80" alt="Resumo da notícia">
            </div>
            <div class="news-card-content">
                <span class="news-tag">Direito Administrativo</span>
                <h3 class="news-card-title">Licitações públicas: o que muda com a nova lei?</h3>
                <p class="news-card-excerpt">Uma análise detalhada das principais alterações trazidas pelo novo marco legal das licitações e contratos administrativos.</p>
                <div class="news-card-footer">
                    <span class="news-date">05 de Outubro, 2023</span>
                    <a href="<?= base_url('noticias/show/licitacoes-nova-lei') ?>" class="news-read-more">Ler artigo &rarr;</a>
                </div>
            </div>
        </article>

        <!-- Exemplo de Card de Notícia 3 -->
        <article class="news-card">
            <div class="news-card-img">
                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80" alt="Resumo da notícia">
            </div>
            <div class="news-card-content">
                <span class="news-tag">Institucional</span>
                <h3 class="news-card-title">Cardoso & Bruno inaugura nova filial em São Paulo</h3>
                <p class="news-card-excerpt">Expandindo nossa atuação para melhor atender nossos clientes, anunciamos a abertura do nosso novo escritório na capital paulista.</p>
                <div class="news-card-footer">
                    <span class="news-date">28 de Setembro, 2023</span>
                    <a href="<?= base_url('noticias/show/nova-filial-sp') ?>" class="news-read-more">Ler artigo &rarr;</a>
                </div>
            </div>
        </article>
    </div>
</section>

<?= $this->endSection() ?>