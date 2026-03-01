<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardoso & Bruno — Advocacia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/dist/css/style.css'); ?>">
</head>

<body>

    <!-- NAV -->
    <nav>
        <div class="logo">
            <img src="<?= base_url('public/dist/imgs/logo.png'); ?>" alt="Logo Cardoso & Bruno" style="max-height: 70px; width: auto; object-fit: contain;">
        </div>
        <ul class="nav-links">
            <li><a href="#expertise">Áreas de Atuação</a></li>
            <li><a href="#civil">Direito Civil</a></li>
            <li><a href="#administrativo">Direito Administrativo</a></li>
            <li><a href="#contato">Contato</a></li>
        </ul>
        <button class="nav-cta">Consulta Inicial</button>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-left">
            <div class="hero-badge">Fundado em 2018 — Belo Horizonte, MG</div>
            <h1 class="hero-title">
                Precisão jurídica.<br>
                <em>Resultados concretos.</em>
            </h1>
            <div class="hero-divider"></div>
            <p class="hero-sub">
                Especialistas em Direito Civil e Administrativo, atuando com rigor técnico e comprometimento ético na defesa dos interesses de pessoas físicas, empresas e entidades em todo o estado de Minas Gerais.
            </p>
            <div class="hero-actions">
                <button class="btn-primary" onclick="document.getElementById('contato').scrollIntoView({behavior:'smooth'})">Fale com um Advogado</button>
                <button class="btn-ghost" onclick="document.getElementById('expertise').scrollIntoView({behavior:'smooth'})">Nossas Especialidades</button>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-img-container"></div>
            <div class="hero-overlay-text">§</div>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-num">7+</div>
                    <div class="stat-label">Anos de Atuação</div>
                </div>
                <div class="stat">
                    <div class="stat-num">MG</div>
                    <div class="stat-label">Abrangência Estadual</div>
                </div>
                <div class="stat">
                    <div class="stat-num">2</div>
                    <div class="stat-label">Especialidades Principais</div>
                </div>
            </div>
        </div>
    </section>

    <div class="gold-line"></div>

    <!-- EXPERTISE -->
    <section class="expertise" id="expertise">
        <div class="section-eyebrow">Áreas de Atuação</div>
        <h2 class="section-title">Soluções jurídicas com profundidade técnica</h2>

        <div class="expertise-grid">
            <div class="expertise-card reveal">
                <div class="card-number">01</div>
                <div class="card-title">Direito Civil</div>
                <p class="card-desc">Atuação estratégica em contratos, responsabilidade civil, direito de família, sucessões e contencioso cível. Defendemos interesses de pessoas físicas e jurídicas com excelência processual.</p>
                <span class="card-tag">Ver mais</span>
            </div>
            <div class="expertise-card reveal">
                <div class="card-number">02</div>
                <div class="card-title">Direito Administrativo</div>
                <p class="card-desc">Profunda experiência em licitações, contratos administrativos, processos disciplinares, improbidade administrativa e relações entre particulares e o Poder Público.</p>
                <span class="card-tag">Ver mais</span>
            </div>
            <div class="expertise-card reveal">
                <div class="card-number">03</div>
                <div class="card-title">Contratos & Negócios</div>
                <p class="card-desc">Elaboração, revisão e negociação de contratos empresariais complexos, com foco na proteção patrimonial e na prevenção de litígios.</p>
                <span class="card-tag">Ver mais</span>
            </div>
            <div class="expertise-card reveal">
                <div class="card-number">04</div>
                <div class="card-title">Advocacia Colaborativa</div>
                <p class="card-desc">Resolução de conflitos por meio do diálogo e da cooperação, preservando relacionamentos e construindo acordos duradouros sem a necessidade de litigio judicial.</p>
                <span class="card-tag">Ver mais</span>
            </div>
        </div>
    </section>

    <!-- PILARES -->
    <section class="pillars">
        <div class="pillars-text">
            <div class="section-eyebrow">Por que Cardoso & Bruno</div>
            <h2 class="section-title reveal" style="color: var(--cream);">Uma advocacia construída sobre pilares sólidos</h2>
            <p>Nascemos do Direito Público — procuradores do CRBIO — e crescemos com a confiança de clientes que exigem mais do que processos: exigem estratégia, transparência e resultados.</p>
        </div>

        <div class="pillars-list">
            <div class="pillar-item reveal">
                <div class="pillar-icon">⚖</div>
                <div>
                    <div class="pillar-name">Rigor Técnico</div>
                    <p class="pillar-desc">Formação jurídica consolidada, com origem no Direito Público e expansão às mais relevantes áreas do Direito Civil.</p>
                </div>
            </div>
            <div class="pillar-item reveal">
                <div class="pillar-icon">🏛</div>
                <div>
                    <div class="pillar-name">Experiência Institucional</div>
                    <p class="pillar-desc">Fundado por ex-procuradores de Conselho Federal, com visão aprofundada das relações entre Estado e particular.</p>
                </div>
            </div>
            <div class="pillar-item reveal">
                <div class="pillar-icon">🤝</div>
                <div>
                    <div class="pillar-name">Atendimento Personalizado</div>
                    <p class="pillar-desc">Cada cliente recebe atenção direta dos sócios, garantindo soluções sob medida para cada situação específica.</p>
                </div>
            </div>
            <div class="pillar-item reveal">
                <div class="pillar-icon">📍</div>
                <div>
                    <div class="pillar-name">Abrangência em MG</div>
                    <p class="pillar-desc">Atuação em todo o estado de Minas Gerais, com base sólida em Belo Horizonte.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- DESTAQUES CIVIL / ADMINISTRATIVO -->
    <div class="highlight-split">

        <div class="highlight-panel dark" id="civil">
            <div class="section-eyebrow">Especialidade</div>
            <h2 class="section-title" style="color:var(--cream);">Direito Civil</h2>
            <ul>
                <li>Contratos cíveis e empresariais</li>
                <li>Responsabilidade civil e indenizações</li>
                <li>Direito de Família e Sucessões</li>
                <li>Planejamento sucessório e holdings familiares</li>
                <li>Contencioso cível judicial e extrajudicial</li>
                <li>Mediação e métodos alternativos de solução</li>
            </ul>
            <div class="bg-number">I</div>
        </div>

        <div class="highlight-panel light" id="administrativo">
            <div class="section-eyebrow">Especialidade</div>
            <h2 class="section-title">Direito Administrativo</h2>
            <ul>
                <li>Licitações e contratos com a Administração Pública</li>
                <li>Processos administrativos disciplinares</li>
                <li>Improbidade administrativa</li>
                <li>Servidores públicos e regimes jurídicos</li>
                <li>Mandado de segurança e ações contra o Estado</li>
                <li>Concessões, permissões e autorizações</li>
            </ul>
            <div class="bg-number" style="color:var(--navy);">II</div>
        </div>

    </div>

    <div class="gold-line"></div>

    <!-- CONTATO -->
    <section class="contact" id="contato">
        <div class="contact-info">
            <div class="section-eyebrow">Contato</div>
            <h2 class="section-title reveal" style="color:var(--cream);">Inicie sua consulta com especialistas</h2>

            <div class="contact-detail">
                <div class="contact-detail-icon">📍</div>
                <div class="contact-detail-text">
                    <span>Endereço</span>
                    <p>Rua Roberto Lúcio Aroeira, 417, Sala 01<br>Bairro Itapoã — Belo Horizonte / MG</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon">📞</div>
                <div class="contact-detail-text">
                    <span>Telefone / WhatsApp</span>
                    <p>(31) 9.9224-6996</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon">✉</div>
                <div class="contact-detail-text">
                    <span>E-mail</span>
                    <p>contato@cardosoebruno.adv.br</p>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Nome completo</label>
                    <input type="text" placeholder="Seu nome">
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" placeholder="(31) 9 0000-0000">
                </div>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" placeholder="seu@email.com">
            </div>
            <div class="form-group">
                <label>Área de interesse</label>
                <select>
                    <option value="">Selecione uma especialidade</option>
                    <option>Direito Civil</option>
                    <option>Direito Administrativo</option>
                    <option>Contratos</option>
                    <option>Família e Sucessões</option>
                    <option>Advocacia Colaborativa</option>
                    <option>Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label>Descreva brevemente sua situação</label>
                <textarea placeholder="Como podemos ajudá-lo?"></textarea>
            </div>
            <button class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-logo">Cardoso & Bruno</div>
        <div class="footer-copy">© 2026 Cardoso & Bruno Sociedade de Advogados. Todos os direitos reservados.<br>OAB/MG</div>
        <ul class="footer-links">
            <li><a href="#">Política de Privacidade</a></li>
            <li><a href="#">Área do Cliente</a></li>
        </ul>
    </footer>

    <script src="<?= base_url('public/dist/js/main.js') ?>"></script>
</body>

</html>