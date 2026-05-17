<template>
  <div class="practice-area-view">
    <!-- HERO DA ÁREA -->
    <header class="area-hero">
      <div class="area-hero-overlay"></div>
      <div class="container px-3 px-md-5 area-hero-container">
        <span class="section-eyebrow">Áreas de Prática</span>
        <h1 class="hero-title">Advocacia <em>Colaborativa</em></h1>
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
                Oferecemos assessoria jurídica completa e inovadora em advocacia colaborativa, um método alternativo de resolução de conflitos que privilegia o diálogo, a cooperação e a busca por soluções consensuais.
              </p>
              <p>
                Nossa equipe de experientes advogados especializados em advocacia colaborativa está preparada para auxiliar na resolução de diversos tipos de conflitos, desde questões familiares e de sucessões até litígios comerciais e societários, sempre com foco na preservação de relacionamentos e na construção de acordos duradouros.
              </p>

              <h2 class="sub-title mt-5">A advocacia colaborativa é ideal para:</h2>
              <ul class="styled-list gold-bullet">
                <li>Pessoas físicas e casais em divórcio, separação, inventário ou outros conflitos familiares;</li>
                <li>Sócios em dissolução de sociedade ou litígios societários;</li>
                <li>Empresas em conflitos comerciais, como cobranças, contratos, propriedade intelectual, etc.;</li>
                <li>Herdeiros em inventário ou partilha de bens;</li>
                <li>Vizinhos em conflitos imobiliários;</li>
                <li>E em qualquer outro tipo de conflito em que as partes desejem uma resolução consensual e pacífica.</li>
              </ul>

              <h2 class="sub-title mt-5">Nossos serviços em advocacia colaborativa incluem:</h2>
              <ul class="styled-list">
                <li><strong>Orientação sobre o método da advocacia colaborativa:</strong> Explicamos os princípios, benefícios e etapas do processo de advocacia colaborativa, esclarecendo dúvidas e respondendo perguntas.</li>
                <li><strong>Auxílio na organização das reuniões colaborativas:</strong> Facilitamos a comunicação entre as partes, definimos pautas de discussão, criamos um ambiente seguro e construtivo para o diálogo e a busca por soluções.</li>
                <li><strong>Elaboração de acordos colaborativos:</strong> Redigimos acordos claros, objetivos e abrangentes que atendam às necessidades e interesses de todas as partes envolvidas, assegurando a efetividade e o cumprimento das decisões.</li>
                <li><strong>Mediação e facilitação do diálogo:</strong> Atuamos como mediadores imparciais, ajudando as partes a se comunicarem de forma eficaz, identificarem pontos em comum e construírem soluções criativas em conjunto.</li>
                <li><strong>Negociação de interesses:</strong> Auxiliamos na negociação dos termos do acordo, buscando soluções justas e equitativas para todas as partes, preservando o respeito mútuo e a colaboração.</li>
                <li><strong>Homologação do acordo em juízo:</strong> Providenciamos a homologação do acordo colaborativo em juízo, conferindo-lhe força de título executivo judicial, garantindo sua validade e exigibilidade.</li>
              </ul>

              <h2 class="sub-title mt-5">Nossos diferenciais:</h2>
              <ul class="styled-list gold-bullet">
                <li><strong>Equipe especializada:</strong> Contamos com uma equipe de advogados experientes e certificados em advocacia colaborativa, com profundo conhecimento do método e das melhores práticas para resolução de conflitos de forma consensual.</li>
                <li><strong>Abordagem humanizada:</strong> Acreditamos no poder do diálogo e da escuta ativa para a resolução de conflitos. Tratamos cada caso com atenção individualizada, empatia e respeito, buscando soluções que considerem as necessidades e emoções de todas as partes envolvidas.</li>
                <li><strong>Comunicação clara e transparente:</strong> Mantemos as partes informadas sobre o andamento do processo de forma clara, objetiva e transparente, utilizando linguagem acessível e evitando termos jurídicos desnecessários.</li>
                <li><strong>Compromisso com a ética e a qualidade:</strong> Atuamos com ética, profissionalismo e compromisso com a qualidade, buscando sempre a melhor solução para nossos clientes, dentro dos mais altos padrões de conduta.</li>
                <li><strong>Foco em resultados positivos:</strong> Trabalhamos para alcançar acordos colaborativos que atendam às necessidades e interesses de todas as partes envolvidas, restaurando a harmonia, preservando relacionamentos e construindo um futuro mais positivo para todos.</li>
              </ul>

              <div class="contact-cta-box mt-5 p-4 text-center">
                <p class="mb-3">Se você busca uma solução pacífica e duradoura para o seu conflito, entre em contato.</p>
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
                  <router-link to="/pagina/contratos-negocios" class="sidebar-link">
                    <i class="bi bi-chevron-right"></i> Contratos e Negócios
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
  name: 'PaginaColaborativa'
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
