<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('content') ?>

<article class="article-container">
    <header class="article-header">
        <a href="<?= base_url('noticias') ?>" class="article-back-link">&larr; Voltar para Notícias</a>
        <span class="article-tag">Direito Civil</span>
        <h1 class="article-title">Nova legislação sobre contratos digitais entra em vigor</h1>
        <div class="article-meta">
            <span class="article-author">Por <strong>Dr. João Cardoso</strong></span>
            <span class="article-date">10 de Outubro, 2023</span>
        </div>
    </header>

    <figure class="article-featured-image">
        <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1200&q=80" alt="Imagem de destaque sobre contratos digitais">
        <figcaption>A assinatura digital traz agilidade e segurança jurídica para os negócios contemporâneos.</figcaption>
    </figure>

    <div class="article-content">
        <p class="lead">A transformação digital tem alterado profundamente o modo como os negócios são conduzidos. Recentemente, a entrada em vigor de novas legislações marca um passo importante na consolidação dos contratos digitais no país.</p>

        <h2>O que muda na prática?</h2>
        <p>Com as novas diretrizes, as empresas precisam se adaptar não apenas do ponto de vista tecnológico, mas também jurídico. A principal mudança reside na forma como a validade probatória das assinaturas eletrônicas é encarada pelos tribunais.</p>

        <p>De forma geral, podemos observar três grandes eixos de mudança:</p>
        <ul>
            <li><strong>Classificação das assinaturas:</strong> Distinção mais clara entre assinaturas simples, avançadas e qualificadas.</li>
            <li><strong>Presunção de veracidade:</strong> Em contratos B2B, a aceitação mútua da plataforma de assinatura agora possui maior peso probatório.</li>
            <li><strong>Armazenamento de dados:</strong> Regras mais estritas em consonância com a LGPD sobre a guarda dos logs de assinatura.</li>
        </ul>

        <blockquote>
            "O direito não pode ignorar a realidade social. A regulação dos contratos digitais não é um entrave, mas sim a base construída para trazer segurança às relações fluidas do mundo virtual."
        </blockquote>

        <h2>Como se preparar</h2>
        <p>É fundamental que as empresas revisem seus modelos de contratos padrão (templates). Cláusulas que outrora exigiam reconhecimento de firma físico precisam ser adaptadas para prever, de forma explícita, a validade das comunicações e aceites eletrônicos.</p>

        <p>Nosso escritório possui uma equipe dedicada a assessorar empresas nessa transição, garantindo que a agilidade do digital não comprometa a segurança jurídica das operações.</p>
    </div>

    <div class="article-footer">
        <div class="gold-line"></div>
        <div class="article-share">
            <span>Compartilhe este artigo:</span>
            <div class="share-buttons">
                <!-- Ícones de redes sociais fictícios -->
                <a href="#" class="share-btn">LinkedIn</a>
                <a href="#" class="share-btn">Twitter</a>
                <a href="#" class="share-btn">WhatsApp</a>
            </div>
        </div>
    </div>
</article>

<?= $this->endSection() ?>