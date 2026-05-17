<template>
  <div class="home-view">
    <!-- HERO SECTION PREMIUM -->
    <header class="hero-section">
      <div class="hero-bg-overlay"></div>
      <div class="container px-3 px-md-5 hero-container">
        <div class="row align-items-center">
          <div class="col-lg-8 hero-content">
            <span class="section-eyebrow animate-fade-in">Cardoso & Bruno Sociedade de Advogados</span>
            <h1 class="hero-title animate-slide-up">
              Defesa Estratégica e <em>Excelência</em> Jurídica
            </h1>
            <p class="hero-subtitle animate-slide-up-delay">
              Assessoria de alto padrão especializada em Direito Civil, Administrativo e Contratos Complexos. Soluções jurídicas sob medida para empresas e indivíduos.
            </p>
            <div class="hero-actions animate-slide-up-delay-more">
              <router-link to="/#contato" class="btn-gold">Iniciar Consulta</router-link>
              <router-link to="/#expertise" class="btn-outline">Conhecer Áreas</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="gold-line"></div>
    </header>

    <!-- PILARES DE EXCELÊNCIA (Valores) -->
    <section class="pillars-section py-5">
      <div class="container px-3 px-md-5">
        <div class="row g-4">
          <div class="col-md-4">
            <div class="pillar-card">
              <div class="pillar-icon" aria-hidden="true"><i class="bi bi-award"></i></div>
              <h3 class="pillar-title">Rigor Técnico</h3>
              <p class="pillar-text">
                Análise aprofundada da legislação, doutrina e jurisprudência para construir defesas jurídicas sólidas e inovadoras.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="pillar-card">
              <div class="pillar-icon" aria-hidden="true"><i class="bi bi-shield-check"></i></div>
              <h3 class="pillar-title">Ética e Integridade</h3>
              <p class="pillar-text">
                Relações baseadas na mais absoluta transparência, lealdade e compromisso ético na condução de cada demanda.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="pillar-card">
              <div class="pillar-icon" aria-hidden="true"><i class="bi bi-graph-up-arrow"></i></div>
              <h3 class="pillar-title">Foco em Resultados</h3>
              <p class="pillar-text">
                Abordagem estratégica voltada a mitigar riscos e maximizar oportunidades, buscando a resolução célere de conflitos.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="gold-line" id="expertise"></div>

    <!-- ÁREAS DE ATUAÇÃO (Expertise) -->
    <section class="expertise-section py-5">
      <div class="container px-3 px-md-5">
        <div class="text-center mb-5">
          <span class="section-eyebrow">Áreas de Prática</span>
          <h2 class="section-title">Especialidades de Atuação</h2>
        </div>
        
        <div class="row g-4">
          <!-- Card 1 -->
          <div class="col-md-6 col-lg-3">
            <div class="expertise-card">
              <h3 class="expertise-title">Direito Civil</h3>
              <p class="expertise-text">Cobranças, indenizações por danos morais/materiais, direito de família, heranças e usucapião.</p>
              <router-link to="/pagina/direito-civil" class="expertise-link">
                Ver Detalhes <i class="bi bi-arrow-right"></i>
              </router-link>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="col-md-6 col-lg-3">
            <div class="expertise-card">
              <h3 class="expertise-title">Direito Administrativo</h3>
              <p class="expertise-text">Assessoria em licitações, processos e sanções públicas, defesas regulatórias e servidores.</p>
              <router-link to="/pagina/direito-administrativo" class="expertise-link">
                Ver Detalhes <i class="bi bi-arrow-right"></i>
              </router-link>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="col-md-6 col-lg-3">
            <div class="expertise-card">
              <h3 class="expertise-title">Contratos</h3>
              <p class="expertise-text">Elaboração, análise minuciosa, renegociação e revisão de pactos cíveis e comerciais complexos.</p>
              <router-link to="/pagina/contratos-negocios" class="expertise-link">
                Ver Detalhes <i class="bi bi-arrow-right"></i>
              </router-link>
            </div>
          </div>
          <!-- Card 4 -->
          <div class="col-md-6 col-lg-3">
            <div class="expertise-card">
              <h3 class="expertise-title">Advocacia Colaborativa</h3>
              <p class="expertise-text">Resolução consensual de conflitos de forma humanizada, reduzindo custos e litígios judiciais prolongados.</p>
              <router-link to="/pagina/advocacia-colaborativa" class="expertise-link">
                Ver Detalhes <i class="bi bi-arrow-right"></i>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="gold-line" id="noticias"></div>

    <!-- ÚLTIMAS NOTÍCIAS (Destaques) -->
    <section class="highlights-section py-5">
      <div class="container px-3 px-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
          <div>
            <span class="section-eyebrow">Conteúdo Jurídico</span>
            <h2 class="section-title mb-0">Artigos Recentes</h2>
          </div>
          <router-link to="/noticias" class="btn-outline-gold mt-3 mt-md-0">
            Ver Todas Notícias <i class="bi bi-chevron-right"></i>
          </router-link>
        </div>

        <div class="row g-4">
          <div v-if="loadingNews" class="col-12 text-center py-5">
            <div class="spinner-border text-warning" role="status">
              <span class="visually-hidden">Carregando...</span>
            </div>
          </div>
          <div v-else-if="news.length === 0" class="col-12 text-center py-5">
            <p class="text-muted">Nenhum artigo publicado no momento.</p>
          </div>
          <div v-else v-for="article in news" :key="article.id" class="col-md-4">
            <article class="news-card">
              <div class="news-card-content">
                <span class="news-date">{{ formatDate(article.published_at) }}</span>
                <h3 class="news-card-title">{{ article.title }}</h3>
                <p class="news-card-excerpt">{{ article.summary }}</p>
                <router-link :to="'/noticias/' + article.slug" class="news-card-link">
                  Ler Artigo <i class="bi bi-arrow-right"></i>
                </router-link>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <div class="gold-line" id="contato"></div>

    <!-- FORMULÁRIO DE CONTATO PREMIUM -->
    <section class="contact-section py-5">
      <div class="container px-3 px-md-5">
        <div class="row g-5">
          <!-- Informações de Contato -->
          <div class="col-lg-5">
            <span class="section-eyebrow">Contato</span>
            <h2 class="section-title">Inicie sua Consulta Conosco</h2>
            <p class="contact-description">
              Entre em contato para apresentar sua demanda jurídica. Nossa equipe retornará com presteza e o devido sigilo corporativo.
            </p>

            <div class="contact-methods mt-5">
              <div class="contact-item d-flex gap-3 mb-4">
                <div class="contact-icon" aria-hidden="true"><i class="bi bi-geo-alt"></i></div>
                <div>
                  <span class="contact-label">Nosso Escritório</span>
                  <p class="contact-value">Rua Roberto Lúcio Aroeira, 417, Sala 01, Itapoã, Belo Horizonte / MG</p>
                </div>
              </div>
              <div class="contact-item d-flex gap-3 mb-4">
                <div class="contact-icon" aria-hidden="true"><i class="bi bi-telephone"></i></div>
                <div>
                  <span class="contact-label">WhatsApp / Telefone</span>
                  <p class="contact-value">(31) 9.9224-6996</p>
                </div>
              </div>
              <div class="contact-item d-flex gap-3">
                <div class="contact-icon" aria-hidden="true"><i class="bi bi-envelope"></i></div>
                <div>
                  <span class="contact-label">E-mail de Contato</span>
                  <p class="contact-value">contato@cardosoebruno.adv.br</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Formulário -->
          <div class="col-lg-7">
            <div class="contact-form-container">
              <div v-if="submitSuccess" class="success-card text-center p-5 animate-fade-in">
                <div class="success-icon" aria-hidden="true"><i class="bi bi-check-circle"></i></div>
                <h3 class="mt-4 mb-3">Enviado com Sucesso!</h3>
                <p>{{ successMessage }}</p>
                <button @click="resetForm" class="btn-gold mt-3">Enviar Outra Mensagem</button>
              </div>

              <form v-else @submit.prevent="handleSubmit" class="contact-form">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="nome" class="form-label-custom">Nome completo *</label>
                    <input 
                      type="text" 
                      id="nome" 
                      v-model="form.nome" 
                      required 
                      placeholder="Seu nome"
                      class="form-control-custom"
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="telefone" class="form-label-custom">Telefone</label>
                    <input 
                      type="tel" 
                      id="telefone" 
                      v-model="form.telefone" 
                      placeholder="(31) 9 0000-0000"
                      class="form-control-custom"
                    />
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label-custom">E-mail *</label>
                    <input 
                      type="email" 
                      id="email" 
                      v-model="form.email" 
                      required 
                      placeholder="seu@email.com"
                      class="form-control-custom"
                    />
                  </div>
                  <div class="col-12">
                    <label for="area" class="form-label-custom">Área de interesse</label>
                    <select id="area" v-model="form.area" class="form-select-custom">
                      <option value="">Selecione uma especialidade</option>
                      <option v-for="area in areas" :key="area.id" :value="area.id">
                        {{ area.area_interesse }}
                      </option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="mensagem" class="form-label-custom">Descreva brevemente sua situação *</label>
                    <textarea 
                      id="mensagem" 
                      v-model="form.mensagem" 
                      required 
                      placeholder="Como podemos ajudá-lo?"
                      rows="4"
                      class="form-control-custom"
                    ></textarea>
                  </div>
                  
                  <div v-if="submitErrors.length > 0" class="col-12 alert-error">
                    <ul>
                      <li v-for="(err, idx) in submitErrors" :key="idx" v-html="err"></li>
                    </ul>
                  </div>

                  <div class="col-12 mt-4">
                    <button type="submit" class="btn-submit" :disabled="submitting">
                      <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                      {{ submitting ? 'Enviando...' : 'Enviar Consulta' }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

export default {
  name: 'Home',
  setup() {
    const router = useRouter()
    const news = ref([])
    const loadingNews = ref(true)
    
    // Áreas do CRM
    const areas = ref(window.INITIAL_AREAS || [])
    
    // Formulário
    const form = ref({
      nome: '',
      telefone: '',
      email: '',
      area: '',
      mensagem: ''
    })
    
    const submitting = ref(false)
    const submitSuccess = ref(false)
    const successMessage = ref('')
    const submitErrors = ref([])

    onMounted(() => {
      fetchLatestNews()
      if (areas.value.length === 0) {
        fetchAreas()
      }
      
      // Lida com rolagem se a URL tiver hash ao carregar
      handleHashScroll()
    })

    const handleHashScroll = () => {
      const hash = window.location.hash
      if (hash) {
        setTimeout(() => {
          const element = document.querySelector(hash)
          if (element) {
            element.scrollIntoView({ behavior: 'smooth' })
          }
        }, 300)
      }
    }

    const fetchLatestNews = async () => {
      try {
        const base = window.BASE_URL || '/'
        const res = await fetch(`${base.replace(/\/$/, '')}/api/noticias?limit=3`)
        if (res.ok) {
          const result = await res.json()
          news.value = result.data || []
        }
      } catch (err) {
        console.error('Erro ao buscar notícias:', err)
      } finally {
        loadingNews.value = false
      }
    }

    const fetchAreas = async () => {
      try {
        const base = window.BASE_URL || '/'
        const res = await fetch(`${base.replace(/\/$/, '')}/api/areas`)
        if (res.ok) {
          areas.value = await res.json()
        }
      } catch (err) {
        console.error('Erro ao buscar áreas:', err)
      }
    }

    const formatDate = (dateStr) => {
      if (!dateStr) return ''
      const date = new Date(dateStr)
      return date.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      })
    }

    const handleSubmit = async () => {
      submitting.value = true
      submitErrors.value = []
      
      try {
        const base = window.BASE_URL || '/'
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const csrfHeader = document.querySelector('meta[name="csrf-header"]').getAttribute('content') || 'X-CSRF-TOKEN'

        const res = await fetch(`${base.replace(/\/$/, '')}/api/contact`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            [csrfHeader]: csrfToken
          },
          body: JSON.stringify(form.value)
        })

        const result = await res.json()
        
        // Atualiza CSRF Token de retorno se o backend enviar no cabeçalho
        const newCsrf = res.headers.get('X-CSRF-TOKEN')
        if (newCsrf) {
          document.querySelector('meta[name="csrf-token"]').setAttribute('content', newCsrf)
        }

        if (res.ok && result.status === 'success') {
          submitSuccess.value = true
          successMessage.value = result.message
        } else {
          // Trata erros de validação retornados pelo CI4 ApiController
          if (result.messages) {
            submitErrors.value = Object.values(result.messages)
          } else {
            submitErrors.value = [result.message || 'Ocorreu um erro ao enviar sua mensagem. Tente novamente.']
          }
        }
      } catch (err) {
        console.error('Erro de rede ao submeter contato:', err)
        submitErrors.value = ['Erro de conexão com o servidor. Verifique sua rede e tente novamente.']
      } finally {
        submitting.value = false
      }
    }

    const resetForm = () => {
      form.value = {
        nome: '',
        telefone: '',
        email: '',
        area: '',
        mensagem: ''
      }
      submitSuccess.value = false
      successMessage.value = ''
      submitErrors.value = []
    }

    return {
      news,
      loadingNews,
      areas,
      form,
      submitting,
      submitSuccess,
      successMessage,
      submitErrors,
      formatDate,
      handleSubmit,
      resetForm
    }
  }
}
</script>

<style scoped>
/* ==========================================================================
   HERO SECTION DESIGN (VISUAL PREMIUM & PARALLAX EFFECT)
   ========================================================================== */
.hero-section {
  position: relative;
  min-height: 80vh;
  background-image: url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1600&q=80');
  background-size: cover;
  background-position: center;
  background-attachment: scroll;
  display: flex;
  align-items: center;
  padding: 6rem 0;
}

.hero-bg-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(13, 27, 42, 0.95) 0%, rgba(13, 27, 42, 0.7) 100%);
  z-index: 1;
}

.hero-container {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-family: var(--font-serif);
  font-size: 3.5rem;
  font-weight: 700;
  line-height: 1.15;
  color: var(--cream);
  margin-bottom: 1.5rem;
}

.hero-title em {
  font-style: italic;
  color: var(--gold);
}

.hero-subtitle {
  font-family: var(--font-sans);
  font-size: 1.25rem;
  font-weight: 300;
  line-height: 1.6;
  color: var(--text-muted);
  margin-bottom: 2.5rem;
  max-width: 90%;
}

.hero-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.btn-gold {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark);
  font-weight: 600;
  padding: 0.9rem 2.2rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.95rem;
  letter-spacing: 0.05em;
  border: 1px solid transparent;
  box-shadow: 0 4px 15px rgba(201, 168, 76, 0.2);
  transition: var(--transition-smooth);
}

.btn-gold:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(201, 168, 76, 0.35);
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  color: var(--navy-dark);
}

.btn-outline {
  background: transparent;
  color: var(--cream);
  font-weight: 500;
  padding: 0.9rem 2.2rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.95rem;
  letter-spacing: 0.05em;
  border: 1px solid rgba(250, 249, 246, 0.3);
  transition: var(--transition-smooth);
}

.btn-outline:hover {
  background: rgba(250, 249, 246, 0.05);
  border-color: var(--gold);
  color: var(--gold);
}

/* Animations */
.animate-fade-in {
  animation: fadeIn 0.8s ease-out forwards;
}
.animate-slide-up {
  animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.animate-slide-up-delay {
  opacity: 0;
  animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
}
.animate-slide-up-delay-more {
  opacity: 0;
  animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ==========================================================================
   PILARES DE EXCELÊNCIA (VALORES)
   ========================================================================== */
.pillars-section {
  background-color: var(--navy-dark);
}

.pillar-card {
  background: rgba(27, 38, 59, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.03);
  border-radius: 8px;
  padding: 2.5rem 2rem;
  height: 100%;
  transition: var(--transition-smooth);
}

.pillar-card:hover {
  transform: translateY(-5px);
  background: rgba(27, 38, 59, 0.6);
  border-color: var(--glass-border);
}

.pillar-icon {
  font-size: 2.5rem;
  color: var(--gold);
  margin-bottom: 1.5rem;
}

.pillar-title {
  font-family: var(--font-serif);
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 1rem;
}

.pillar-text {
  color: var(--text-muted);
  font-size: 0.95rem;
  line-height: 1.6;
  margin-bottom: 0;
}

/* ==========================================================================
   ÁREAS DE ATUAÇÃO (EXPERTISE)
   ========================================================================== */
.expertise-section {
  background-color: #0A131C;
}

.expertise-card {
  background: rgba(13, 27, 42, 0.5);
  border: 1px solid rgba(201, 168, 76, 0.08);
  border-radius: 6px;
  padding: 2rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: var(--transition-smooth);
}

.expertise-card:hover {
  border-color: var(--gold);
  background: rgba(27, 38, 59, 0.4);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  transform: scale(1.02);
}

.expertise-title {
  font-family: var(--font-serif);
  font-size: 1.4rem;
  font-weight: 600;
  color: var(--gold);
  margin-bottom: 1rem;
}

.expertise-text {
  color: var(--text-muted);
  font-size: 0.9rem;
  line-height: 1.6;
  flex-grow: 1;
}

.expertise-link {
  color: var(--cream);
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin-top: 1.5rem;
  display: inline-block;
  transition: var(--transition-smooth);
}

.expertise-link i {
  transition: var(--transition-smooth);
}

.expertise-link:hover {
  color: var(--gold);
}

.expertise-link:hover i {
  transform: translateX(5px);
}

/* ==========================================================================
   NOTÍCIAS RECENTES
   ========================================================================== */
.highlights-section {
  background-color: var(--navy-dark);
}

.btn-outline-gold {
  background: transparent;
  color: var(--gold);
  font-weight: 600;
  padding: 0.7rem 1.6rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.9rem;
  border: 1px solid var(--gold);
  transition: var(--transition-smooth);
}

.btn-outline-gold:hover {
  background: var(--gold);
  color: var(--navy-dark);
}

.news-card {
  background: rgba(27, 38, 59, 0.3);
  border: 1px solid rgba(255, 255, 255, 0.02);
  border-radius: 6px;
  overflow: hidden;
  height: 100%;
  transition: var(--transition-smooth);
}

.news-card:hover {
  transform: translateY(-5px);
  background: rgba(27, 38, 59, 0.5);
  border-color: rgba(201, 168, 76, 0.2);
}

.news-card-content {
  padding: 2rem;
}

.news-date {
  font-family: var(--font-sans);
  color: var(--gold);
  font-size: 0.8rem;
  font-weight: 500;
  letter-spacing: 0.05em;
  display: block;
  margin-bottom: 0.8rem;
}

.news-card-title {
  font-family: var(--font-serif);
  font-size: 1.4rem;
  font-weight: 600;
  color: var(--cream);
  line-height: 1.3;
  margin-bottom: 1rem;
}

.news-card-excerpt {
  color: var(--text-muted);
  font-size: 0.9rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.news-card-link {
  color: var(--gold);
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
  transition: var(--transition-smooth);
}

.news-card-link:hover {
  color: var(--gold-hover);
}

/* ==========================================================================
   FORMULÁRIO DE CONTATO (GLASSMOPHISM & PREMIUM)
   ========================================================================== */
.contact-section {
  background-color: #0A131C;
}

.contact-description {
  color: var(--text-muted);
  line-height: 1.7;
}

.contact-icon {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: rgba(201, 168, 76, 0.1);
  color: var(--gold);
  font-size: 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  border: 1px solid rgba(201, 168, 76, 0.2);
}

.contact-label {
  font-size: 0.8rem;
  color: var(--gold);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-weight: 600;
  display: block;
}

.contact-value {
  color: var(--text-primary);
  margin-bottom: 0;
  font-size: 0.95rem;
}

.contact-form-container {
  background: rgba(27, 38, 59, 0.35);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(201, 168, 76, 0.1);
  padding: 3rem;
  border-radius: 8px;
}

.form-label-custom {
  font-family: var(--font-sans);
  color: var(--text-muted);
  font-size: 0.85rem;
  font-weight: 500;
  margin-bottom: 0.5rem;
}

.form-control-custom {
  background: rgba(13, 27, 42, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 4px;
  color: var(--cream);
  padding: 0.8rem 1rem;
  font-size: 0.95rem;
  width: 100%;
  transition: var(--transition-smooth);
}

.form-control-custom:focus {
  background: rgba(13, 27, 42, 0.8);
  border-color: var(--gold);
  outline: none;
  box-shadow: 0 0 10px rgba(201, 168, 76, 0.15);
}

.form-select-custom {
  background: rgba(13, 27, 42, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 4px;
  color: var(--cream);
  padding: 0.8rem 1rem;
  font-size: 0.95rem;
  width: 100%;
  appearance: none;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23C9A84C' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 16px 12px;
  transition: var(--transition-smooth);
}

.form-select-custom:focus {
  background-color: rgba(13, 27, 42, 0.8);
  border-color: var(--gold);
  outline: none;
}

.form-select-custom option {
  background-color: var(--navy-dark);
  color: var(--cream);
}

.btn-submit {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark);
  font-weight: 600;
  padding: 0.9rem 2.5rem;
  border-radius: 4px;
  font-size: 0.95rem;
  letter-spacing: 0.05em;
  border: none;
  cursor: pointer;
  width: 100%;
  box-shadow: 0 4px 15px rgba(201, 168, 76, 0.2);
  transition: var(--transition-smooth);
}

.btn-submit:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(201, 168, 76, 0.35);
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Mensagens de Sucesso e Erro */
.success-card {
  color: var(--cream);
}

.success-icon {
  font-size: 4rem;
  color: var(--gold);
}

.alert-error {
  background: rgba(220, 53, 69, 0.1);
  border: 1px solid rgba(220, 53, 69, 0.2);
  border-radius: 4px;
  padding: 1rem 1.5rem;
  color: #f87171;
  font-size: 0.9rem;
}

.alert-error ul {
  margin: 0;
  padding-left: 1.2rem;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  .contact-form-container {
    padding: 2rem 1.5rem;
  }
}
</style>
