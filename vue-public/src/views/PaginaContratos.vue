<template>
  <div class="practice-area-view">
    <!-- HERO DA ÁREA -->
    <header class="area-hero">
      <div class="area-hero-overlay"></div>
      <div class="container px-3 px-md-5 area-hero-container">
        <span class="section-eyebrow">Áreas de Prática</span>
        <h1 class="hero-title">Contratos & <em>Negócios</em></h1>
      </div>
    </header>

    <div class="gold-line"></div>

    <section class="area-content-section py-5">
      <div class="container px-3 px-md-5">
        <div class="row g-5">
          <!-- Conteúdo Principal -->
          <div class="col-lg-8">
            <div class="rich-text-container">
              <p class="lead">
                Oferecemos assessoria jurídica completa e personalizada para empresas e pessoas físicas em todas as etapas de processos contenciosos cíveis.
              </p>
              <p>
                Nossa equipe de experientes advogados especializados em contencioso cível está preparada para defendê-lo com afinco e profissionalismo em litígios judiciais e extrajudiciais, buscando a melhor solução para cada caso, seja através de acordos ou da tutela jurisdicional.
              </p>

              <h2 class="sub-title mt-5">Nossos serviços em contencioso cível incluem:</h2>
              <ul class="styled-list">
                <li><strong>Atuação em diversas áreas do direito civil:</strong> Cobrança de dívidas, indenização por danos materiais e morais, contratos, responsabilidade civil, direito de propriedade, direito de família, sucessões, consumidor, entre outras.</li>
                <li><strong>Análise aprofundada do caso:</strong> Realizamos um estudo minucioso do seu caso, identificando os pontos fortes e fracos, as melhores estratégias e os riscos envolvidos, para garantir uma defesa sólida e eficaz.</li>
                <li><strong>Negociação extrajudicial:</strong> Buscamos a resolução do conflito por meio de acordos amigáveis, sempre que possível, visando minimizar custos e tempo de trâmite processual.</li>
                <li><strong>Atuação em processos judiciais:</strong> Em casos que não sejam solucionados extrajudicialmente, patrocinamos nossos clientes em todas as fases do processo judicial, desde a citação até o trânsito em julgado da decisão, com recursos e acompanhamento constantes.</li>
                <li><strong>Recursos jurídicos:</strong> Caso necessário, interpomos recursos para reverter decisões desfavoráveis, buscando sempre a melhor defesa dos interesses de nossos clientes.</li>
                <li><strong>Execução de decisões judiciais:</strong> Cobramos judicialmente o cumprimento de decisões judiciais favoráveis, assegurando que nossos clientes obtenham o que lhes foi assegurado por lei.</li>
              </ul>

              <h2 class="sub-title mt-5">Nossos diferenciais:</h2>
              <ul class="styled-list gold-bullet">
                <li><strong>Experiência e conhecimento:</strong> Contamos com uma equipe de advogados experientes e com profundo conhecimento em contencioso cível, atualizados sobre as últimas legislações e jurisprudências.</li>
                <li><strong>Visão estratégica:</strong> Analisamos cada caso de forma abrangente, considerando os aspectos jurídicos, fáticos e probatórios, para construir uma estratégia personalizada e eficaz de defesa.</li>
                <li><strong>Comunicação clara e objetiva:</strong> Mantemos nossos clientes informados sobre o andamento dos processos de forma clara, objetiva e transparente, utilizando linguagem acessível e evitando termos jurídicos desnecessários.</li>
                <li><strong>Transparência e ética:</strong> Atuamos com ética, profissionalismo e transparência, sempre informando nossos clientes sobre os custos e honorários advocatícios, e buscando a melhor solução para cada caso, dentro dos mais altos padrões de conduta.</li>
                <li><strong>Compromisso com a excelência:</strong> Dedicação total ao seu caso, buscando sempre a melhor solução para você, com agilidade, eficiência e resultados concretos.</li>
              </ul>

              <h2 class="sub-title mt-5">Áreas de atuação em contencioso cível:</h2>
              <div class="row mt-3">
                <div class="col-md-6">
                  <ul class="styled-list simple">
                    <li>Cobrança de dívidas: Inadimplência contratual, cheques especiais, notas promissórias, duplicatas, etc.</li>
                    <li>Indenização por danos materiais e morais: Acidentes de trânsito, erros médicos, produtos defeituosos, danos à imagem, etc.</li>
                    <li>Descumprimento de contrato: Quebra de contrato, vícios redibitórios, rescisão contratual, etc.</li>
                    <li>Possessão e propriedade: Reintegração de posse, usucapião, divórcio litigioso, partilha de bens, etc.</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul class="styled-list simple">
                    <li>Direito de família: Divórcio, pensão alimentícia, guarda e tutela de filhos, reconhecimento de paternidade, etc.</li>
                    <li>Sucessões: Inventário, testamento, herança, partilha de bens, etc.</li>
                    <li>Direito do consumidor: Defesa do consumidor em compras online, serviços bancários, planos de saúde, etc.</li>
                    <li>E muito mais!</li>
                  </ul>
                </div>
              </div>

              <div class="contact-cta-box mt-5 p-4 text-center">
                <p class="mb-3">Se você está enfrentando um litígio cível ou comercial, entre em contato e agende uma consulta.</p>
                <router-link to="/#contato" class="btn-gold">Agende uma Consulta</router-link>
              </div>
            </div>
          </div>

          <!-- Barra Lateral (Sidebar) -->
          <div class="col-lg-4">
            <aside class="sidebar-box p-4">
              <h3 class="sidebar-title">Outras Áreas</h3>
              <ul class="sidebar-menu">
                <li>
                  <router-link to="/pagina/direito-civil" class="sidebar-link">
                    <i class="bi bi-chevron-right"></i> Direito Civil
                  </router-link>
                </li>
                <li>
                  <router-link to="/pagina/direito-administrativo" class="sidebar-link">
                    <i class="bi bi-chevron-right"></i> Direito Administrativo
                  </router-link>
                </li>
                <li>
                  <router-link to="/pagina/advocacia-colaborativa" class="sidebar-link">
                    <i class="bi bi-chevron-right"></i> Advocacia Colaborativa
                  </router-link>
                </li>
              </ul>
            </aside>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'PaginaContratos'
}
</script>

<style scoped>
/* Estilos Compartilhados para Páginas Estáticas */
.area-hero {
  position: relative;
  background-image: url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1600&q=80');
  background-size: cover;
  background-position: center;
  height: 40vh;
  min-height: 280px;
  display: flex;
  align-items: center;
}

.area-hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, rgba(13, 27, 42, 0.95) 0%, rgba(13, 27, 42, 0.75) 100%);
  z-index: 1;
}

.area-hero-container {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-family: var(--font-serif);
  font-size: 3rem;
  font-weight: 700;
  color: var(--cream);
}

.hero-title em {
  font-style: italic;
  color: var(--gold);
}

/* Corpo de Conteúdo */
.area-content-section {
  background-color: var(--navy-dark);
}

.rich-text-container {
  color: var(--text-muted);
  line-height: 1.8;
  font-size: 1.05rem;
}

.rich-text-container p {
  margin-bottom: 1.5rem;
}

.lead {
  font-size: 1.25rem;
  font-weight: 300;
  color: var(--cream);
  line-height: 1.6;
}

.sub-title {
  font-family: var(--font-serif);
  font-size: 1.7rem;
  font-weight: 600;
  color: var(--gold);
  margin-bottom: 1.5rem;
}

.styled-list {
  list-style: none;
  padding-left: 0;
  margin-bottom: 2rem;
}

.styled-list li {
  position: relative;
  padding-left: 1.8rem;
  margin-bottom: 1rem;
}

.styled-list li::before {
  content: '\F2E6';
  font-family: 'bootstrap-icons';
  position: absolute;
  left: 0;
  top: 0.1rem;
  color: var(--gold);
  font-size: 1.1rem;
}

.styled-list.gold-bullet li::before {
  content: '\F2EC';
  color: var(--gold);
}

.styled-list.simple li::before {
  content: '\F2E5';
  font-size: 0.9rem;
  top: 0.2rem;
}

/* CTA Box */
.contact-cta-box {
  background: rgba(27, 38, 59, 0.4);
  border: 1px solid rgba(201, 168, 76, 0.15);
  border-radius: 6px;
  color: var(--cream);
}

.btn-gold {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark);
  font-weight: 600;
  padding: 0.7rem 2rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.9rem;
  display: inline-block;
  transition: var(--transition-smooth);
}

.btn-gold:hover {
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(201, 168, 76, 0.3);
}

/* Sidebar */
.sidebar-box {
  background: rgba(27, 38, 59, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.02);
  border-radius: 6px;
}

.sidebar-title {
  font-family: var(--font-serif);
  font-size: 1.4rem;
  color: var(--cream);
  margin-bottom: 1.5rem;
  position: relative;
  padding-bottom: 0.5rem;
}

.sidebar-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 30px;
  height: 2px;
  background-color: var(--gold);
}

.sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-menu li {
  margin-bottom: 0.8rem;
}

.sidebar-link {
  color: var(--text-muted);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  transition: var(--transition-smooth);
}

.sidebar-link:hover {
  color: var(--gold);
  padding-left: 5px;
}

.sidebar-link.router-link-active {
  color: var(--gold);
  font-weight: 600;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.2rem;
  }
}
</style>
