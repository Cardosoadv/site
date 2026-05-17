<template>
  <div class="noticias-detail-view">
    <!-- SPINNER CARREGANDO -->
    <div v-if="loading" class="text-center py-5 loading-container">
      <div class="spinner-border text-warning" role="status">
        <span class="visually-hidden">Carregando...</span>
      </div>
    </div>

    <!-- ERRO / NÃO ENCONTRADO -->
    <div v-else-if="error" class="container py-5 text-center empty-container animate-fade-in">
      <i class="bi bi-exclamation-triangle empty-icon" aria-hidden="true"></i>
      <h2 class="mt-4">Artigo não encontrado</h2>
      <p class="text-muted">O artigo solicitado pode ter sido removido ou o link está incorreto.</p>
      <router-link to="/noticias" class="btn-gold mt-3">Voltar para notícias</router-link>
    </div>

    <!-- CONTEÚDO DO ARTIGO -->
    <div v-else class="animate-fade-in">
      <div class="news-detail-hero">
        <div class="hero-overlay"></div>
        <div class="container px-3 px-md-5 hero-inner">
          <router-link to="/noticias" class="btn-back">
            <i class="bi bi-arrow-left"></i> Voltar para a listagem
          </router-link>
        </div>
      </div>

      <article class="article-container container py-5 px-3 px-md-5">
        <header class="article-header mb-5">
          <span v-if="article.category_name" class="article-category">
            #{{ article.category_name }}
          </span>
          <h1 class="article-title">{{ article.title }}</h1>
          
          <div class="article-meta">
            <span class="meta-item">
              <i class="bi bi-calendar3" aria-hidden="true"></i>
              Publicado em: {{ formatDate(article.published_at) }}
            </span>
          </div>
        </header>

        <!-- Corpo do Texto Renderizado em HTML -->
        <div class="article-content" v-html="article.content"></div>

        <!-- Rodapé do Artigo: Compartilhamento e Tags -->
        <footer class="article-footer mt-5 pt-4 border-top">
          <div class="row align-items-center justify-content-between g-3">
            <div class="col-md-6 d-flex align-items-center gap-3">
              <span class="share-title">Compartilhar:</span>
              <a 
                :href="linkedinShareUrl" 
                target="_blank" 
                rel="noopener" 
                class="btn-share" 
                title="Compartilhar no LinkedIn"
                aria-label="Compartilhar este artigo no LinkedIn"
              >
                <i class="bi bi-linkedin"></i>
              </a>
              <a 
                :href="whatsappShareUrl" 
                target="_blank" 
                rel="noopener" 
                class="btn-share" 
                title="Compartilhar no WhatsApp"
                aria-label="Compartilhar este artigo no WhatsApp"
              >
                <i class="bi bi-whatsapp"></i>
              </a>
            </div>
            
            <div v-if="article.category_name" class="col-md-6 text-md-end">
              <span class="badge-category">#{{ article.category_name }}</span>
            </div>
          </div>
        </footer>
      </article>

      <div class="gold-line"></div>

      <!-- SEÇÃO LEIA TAMBÉM (ARTIGOS RELACIONADOS) -->
      <section v-if="related.length > 0" class="related-section py-5">
        <div class="container px-3 px-md-5">
          <h2 class="related-title mb-4">Leia também</h2>
          
          <div class="row g-4">
            <div v-for="rel in related" :key="rel.id" class="col-md-4">
              <div class="news-card">
                <div class="news-card-content">
                  <span class="news-date">{{ formatDate(rel.published_at) }}</span>
                  <h3 class="news-card-title">{{ rel.title }}</h3>
                  <router-link :to="'/noticias/' + rel.slug" class="news-card-link">
                    Ler Artigo <i class="bi bi-arrow-right"></i>
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch, computed } from 'vue'
import { useRoute } from 'vue-router'

export default {
  name: 'NoticiasDetail',
  setup() {
    const route = useRoute()
    const article = ref(null)
    const related = ref([])
    const loading = ref(true)
    const error = ref(false)

    const fetchArticleDetail = async (slug) => {
      loading.value = true
      error.value = false
      
      try {
        const base = window.BASE_URL || '/'
        const url = `${base.replace(/\/$/, '')}/api/noticias/${slug}`
        const res = await fetch(url)
        
        if (res.ok) {
          const result = await res.json()
          article.value = result.article || null
          related.value = result.related || []
          
          if (!article.value) {
            error.value = true
          } else {
            // Atualiza o título da aba dinamicamente no navegador (Client-Side SEO)
            document.title = (article.value.meta_title || article.value.title) + ' | Cardoso & Bruno';
          }
        } else {
          error.value = true
        }
      } catch (err) {
        console.error('Erro ao carregar detalhes do artigo:', err)
        error.value = true
      } finally {
        loading.value = false
      }
    }

    onMounted(() => {
      fetchArticleDetail(route.params.slug)
    })

    // Re-carrega os dados do artigo se o slug da rota mudar (ex: clicar em Leia Também)
    watch(
      () => route.params.slug,
      (newSlug) => {
        if (newSlug) {
          fetchArticleDetail(newSlug)
        }
      }
    )

    const formatDate = (dateStr) => {
      if (!dateStr) return ''
      const date = new Date(dateStr)
      return date.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      })
    }

    // Compartilhamento nas redes sociais
    const currentUrl = computed(() => {
      return window.location.href
    })

    const linkedinShareUrl = computed(() => {
      if (!article.value) return '#'
      return `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl.value)}`
    })

    const whatsappShareUrl = computed(() => {
      if (!article.value) return '#'
      const text = `${article.value.title} - ${currentUrl.value}`
      return `https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`
    })

    return {
      article,
      related,
      loading,
      error,
      formatDate,
      linkedinShareUrl,
      whatsappShareUrl
    }
  }
}
</script>

<style scoped>
.loading-container, .empty-container {
  min-height: 50vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.empty-icon {
  font-size: 4rem;
  color: var(--gold);
}

.btn-gold {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark);
  font-weight: 600;
  padding: 0.6rem 2rem;
  border-radius: 4px;
  border: none;
  font-size: 0.9rem;
  text-decoration: none;
  display: inline-block;
  transition: var(--transition-smooth);
}

.btn-gold:hover {
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  transform: translateY(-1px);
  color: var(--navy-dark);
}

/* ==========================================================================
   HERO DE FUNDO DO ARTIGO
   ========================================================================== */
.news-detail-hero {
  position: relative;
  background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1600&q=80');
  background-size: cover;
  background-position: center;
  height: 250px;
  display: flex;
  align-items: flex-end;
  padding-bottom: 2rem;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, rgba(13, 27, 42, 0.9) 0%, rgba(13, 27, 42, 0.6) 100%);
  z-index: 1;
}

.hero-inner {
  position: relative;
  z-index: 2;
}

.btn-back {
  background: transparent;
  color: var(--gold);
  border: 1px solid var(--gold);
  padding: 0.5rem 1.2rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 500;
  transition: var(--transition-smooth);
}

.btn-back:hover {
  background: var(--gold);
  color: var(--navy-dark);
}

/* ==========================================================================
   ESTRUTURA E ESTILO DO ARTIGO (HIGH-END READABILITY)
   ========================================================================== */
.article-container {
  background-color: var(--navy-dark);
  max-width: 850px;
  margin: 0 auto;
  line-height: 1.8;
  font-family: var(--font-sans);
  color: #E2E8F0; /* Slate 200 */
}

.article-category {
  font-family: var(--font-sans);
  color: var(--gold);
  font-size: 0.9rem;
  font-weight: 600;
  letter-spacing: 0.05em;
  display: block;
  margin-bottom: 0.5rem;
}

.article-title {
  font-family: var(--font-serif);
  font-size: 3rem;
  font-weight: 700;
  line-height: 1.2;
  color: var(--cream);
  margin-bottom: 1.5rem;
}

.article-meta {
  color: var(--text-muted);
  font-size: 0.9rem;
  display: flex;
  gap: 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  padding-bottom: 1.5rem;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

/* Estilização para o v-html do Conteúdo Rico */
.article-content {
  font-size: 1.125rem; /* ~18px para leitura extremamente confortável */
  font-weight: 300;
}

.article-content :deep(p) {
  margin-bottom: 1.8rem;
  text-align: justify;
}

.article-content :deep(h2), .article-content :deep(h3) {
  font-family: var(--font-serif);
  color: var(--gold);
  margin-top: 2.5rem;
  margin-bottom: 1.2rem;
  font-weight: 600;
}

.article-content :deep(h2) {
  font-size: 1.8rem;
}

.article-content :deep(h3) {
  font-size: 1.4rem;
}

.article-content :deep(ul), .article-content :deep(ol) {
  margin-bottom: 1.8rem;
  padding-left: 1.5rem;
}

.article-content :deep(li) {
  margin-bottom: 0.6rem;
}

.article-content :deep(strong) {
  color: var(--cream);
  font-weight: 600;
}

.article-content :deep(blockquote) {
  border-left: 3px solid var(--gold);
  padding-left: 1.5rem;
  font-style: italic;
  color: var(--text-muted);
  margin: 2rem 0;
  background: rgba(255, 255, 255, 0.02);
  padding-top: 1rem;
  padding-bottom: 1rem;
}

/* Rodapé do Artigo */
.share-title {
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-muted);
}

.btn-share {
  background: transparent;
  color: var(--text-muted);
  border: 1px solid rgba(255, 255, 255, 0.1);
  width: 36px;
  height: 36px;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: var(--transition-smooth);
  text-decoration: none;
}

.btn-share:hover {
  border-color: var(--gold);
  color: var(--gold);
  background: rgba(201, 168, 76, 0.05);
}

.badge-category {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.05);
  color: var(--text-muted);
  padding: 0.4rem 1rem;
  border-radius: 20px;
  font-size: 0.8rem;
}

/* ==========================================================================
   LEIA TAMBÉM (RELATED ARTICLES)
   ========================================================================== */
.related-section {
  background-color: #0A131C;
}

.related-title {
  font-family: var(--font-serif);
  font-size: 1.8rem;
  color: var(--cream);
  position: relative;
  padding-bottom: 0.5rem;
}

.related-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 40px;
  height: 2px;
  background-color: var(--gold);
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
  transform: translateY(-4px);
  background: rgba(27, 38, 59, 0.5);
  border-color: rgba(201, 168, 76, 0.2);
}

.news-card-content {
  padding: 1.8rem;
}

.news-date {
  font-family: var(--font-sans);
  color: var(--gold);
  font-size: 0.8rem;
  font-weight: 500;
  display: block;
  margin-bottom: 0.5rem;
}

.news-card-title {
  font-family: var(--font-serif);
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--cream);
  line-height: 1.35;
  margin-bottom: 1.2rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.7rem;
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

.animate-fade-in {
  animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@media (max-width: 768px) {
  .article-title {
    font-size: 2.2rem;
  }
  .news-detail-hero {
    height: 180px;
  }
}
</style>
