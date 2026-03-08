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
        <span class="section-eyebrow justify-content-center">Direito Civil</span>
        <h1 class="article-title">A Importância da Advocacia Colaborativa na Resolução de Conflitos Familiares</h1>
        
        <div class="article-meta">
            <span><i class="bi bi-person"></i> Dr. Fabiano Cardoso</span>
            <span><i class="bi bi-calendar3"></i> 08 de Março de 2026</span>
            <span><i class="bi bi-clock"></i> 5 min de leitura</span>
        </div>
    </header>

    <div class="article-content">
        <p class="lead" style="font-size: 1.3rem; color: var(--navy-mid); font-weight: 500;">
            A advocacia colaborativa surge como uma alternativa humanizada e eficaz, priorizando o diálogo e a construção de acordos que respeitem a dignidade das partes envolvidas.
        </p>

        <p>Tradicionalmente, o direito de família é visto como um campo de batalha. No entanto, a prática colaborativa inverte essa lógica. Em vez de delegar a decisão a um juiz, as partes mantêm o controle sobre o resultado, assistidas por advogados treinados em negociação facilitadora.</p>

        <blockquote>
            "O sucesso de um acordo colaborativo não se mede apenas pela assinatura do documento, mas pela preservação dos vínculos e pela sustentabilidade das decisões a longo prazo."
        </blockquote>

        <h2>O Papel do Advogado Colaborativo</h2>
        <p>Diferente do litígio clássico, o advogado colaborativo atua como um facilitador. As partes assinam um termo de não-litigância, comprometendo-se a não levar a disputa ao tribunal enquanto durar o processo de negociação.</p>
        
        <ul>
            <li>Transparência total de informações patrimoniais.</li>
            <li>Foco nas necessidades reais de cada membro da família.</li>
            <li>Participação de equipe multidisciplinar (psicólogos e consultores financeiros).</li>
        </ul>

        <p>Em Minas Gerais, temos observado um crescimento significativo na adoção desses métodos, especialmente em processos de inventário e divórcio, onde o tempo e o custo emocional de um processo judicial seriam proibitivos.</p>
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
        <div class="col-md-4">
            <div class="news-card">
                <div class="news-card-content">
                    <span class="news-date">05 Mar 2026</span>
                    <h5 class="news-card-title" style="font-size: 1.1rem;">A nova lei de licitações e os impactos municipais</h5>
                    <a href="#" class="card-tag">Ler artigo</a>
                </div>
            </div>
        </div>
        <!-- Repetir para outros posts -->
    </div>
</section>

<?= $this->endSection() ?>