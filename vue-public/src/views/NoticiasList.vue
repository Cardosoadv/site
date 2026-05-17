<template>
  <div class="noticias-list-view">
    <!-- HERO DE NOTÍCIAS -->
    <header class="news-hero">
      <div class="news-hero-overlay"></div>
      <div class="container px-3 px-md-5 news-hero-container">
        <span class="section-eyebrow">Conteúdo Jurídico</span>
        <h1 class="hero-title">Artigos & <em>Atualizações</em></h1>
        <p class="hero-sub mx-auto">
          Análise técnica sobre as principais mudanças legislativas e jurisprudenciais do Direito Brasileiro.
        </p>
      </div>
    </header>

    <div class="gold-line"></div>

    <section class="news-list-section py-5">
      <div class="container px-3 px-md-5">
        
        <!-- BARRA DE BUSCA E FILTROS -->
        <div class="search-filter-container mb-5">
          <div class="row g-3 align-items-center justify-content-between">
            <!-- Filtros Rápidos -->
            <div class="col-lg-6 d-flex gap-2 flex-wrap">
              <button 
                @click="setQuickSearch('')" 
                class="btn-filter"
                :class="{ 'active': searchQuery === '' }"
              >
                Todos
              </button>
              <button 
                @click="setQuickSearch('Direito Civil')" 
                class="btn-filter"
                :class="{ 'active': searchQuery === 'Direito Civil' }"
              >
                Direito Civil
              </button>
              <button 
                @click="setQuickSearch('Administrativo')" 
                class="btn-filter"
                :class="{ 'active': searchQuery === 'Administrativo' }"
              >
                Administrativo
              </button>
              <button 
                @click="setQuickSearch('Contratos')" 
                class="btn-filter"
                :class="{ 'active': searchQuery === 'Contratos' }"
              >
                Contratos
              </button>
            </div>

            <!-- Busca Textual -->
            <div class="col-lg-4">
              <div class="search-input-group">
                <i class="bi bi-search search-icon" aria-hidden="true"></i>
                <input 
                  type="text" 
                  v-model="searchQuery" 
                  @input="handleSearchInput" 
                  placeholder="Pesquisar artigos..." 
                  class="search-field"
                  aria-label="Pesquisar artigos"
                />
                <button v-if="searchQuery" @click="clearSearch" class="btn-clear" aria-label="Limpar busca">
                  <i class="bi bi-x"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- GRID DE ARTIGOS -->
        <div v-if="loading" class="text-center py-5">
          <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Carregando...</span>
          </div>
        </div>

        <div v-else-if="articles.length === 0" class="text-center py-5 empty-state animate-fade-in">
          <i class="bi bi-journal-x empty-icon" aria-hidden="true"></i>
          <h3 class="mt-4">Nenhum artigo encontrado</h3>
          <p class="text-muted">Tente alterar os termos de busca ou filtros.</p>
          <button @click="clearSearch" class="btn-gold mt-3">Ver Todos os Artigos</button>
        </div>

        <div v-else class="animate-fade-in">
          <div class="row g-4 news-grid">
            <div v-for="article in articles" :key="article.id" class="col-md-6 col-lg-4">
              <article class="news-card">
                <div class="news-card-content">
                  <span class="news-date">{{ formatDate(article.published_at) }}</span>
                  <h3 class="news-card-title">{{ article.title }}</h3>
                  <p class="news-card-excerpt">{{ article.summary }}</p>
                  <router-link :to="'/noticias/' + article.slug" class="news-card-link" :aria-label="'Ler artigo sobre ' + article.title">
                    Ler Artigo <i class="bi bi-arrow-right"></i>
                  </router-link>
                </div>
              </article>
            </div>
          </div>

          <!-- PAGINAÇÃO PREMIUM -->
          <nav v-if="lastPage > 1" class="d-flex justify-content-center mt-5" aria-label="Navegação de páginas">
            <ul class="pagination-custom">
              <li class="page-item-custom">
                <button 
                  @click="goToPage(currentPage - 1)" 
                  :disabled="currentPage === 1"
                  class="page-link-custom"
                  aria-label="Página anterior"
                >
                  <i class="bi bi-chevron-left"></i>
                </button>
              </li>
              
              <li v-for="p in visiblePages" :key="p" class="page-item-custom">
                <span v-if="p === '...'" class="page-link-custom dots">...</span>
                <button 
                  v-else
                  @click="goToPage(p)" 
                  class="page-link-custom"
                  :class="{ 'active': p === currentPage }"
                  :aria-current="p === currentPage ? 'page' : undefined"
                >
                  {{ p }}
                </button>
              </li>

              <li class="page-item-custom">
                <button 
                  @click="goToPage(currentPage + 1)" 
                  :disabled="currentPage === lastPage"
                  class="page-link-custom"
                  aria-label="Próxima página"
                >
                  <i class="bi bi-chevron-right"></i>
                </button>
              </li>
            </ul>
          </nav>
        </div>

      </div>
    </section>
  </div>
</template>

<script>
import { ref, computed, onMounted, watch } from 'vue'

export default {
  name: 'NoticiasList',
  setup() {
    const articles = ref([])
    const total = ref(0)
    const currentPage = ref(1)
    const lastPage = ref(1)
    const limit = ref(9) // 9 artigos por página é perfeito para grid de 3 colunas
    const loading = ref(true)
    const searchQuery = ref('')
    
    let searchDebounceTimeout = null

    const fetchArticles = async () => {
      loading.value = true
      try {
        const base = window.BASE_URL || '/'
        const url = `${base.replace(/\/$/, '')}/api/noticias?page=${currentPage.value}&limit=${limit.value}&search=${encodeURIComponent(searchQuery.value)}`
        const res = await fetch(url)
        if (res.ok) {
          const result = await res.json()
          articles.value = result.data || []
          total.value = result.total || 0
          lastPage.value = result.last_page || 1
        }
      } catch (err) {
        console.error('Erro ao carregar notícias:', err)
      } finally {
        loading.value = false
      }
    }

    onMounted(() => {
      fetchArticles()
    })

    const handleSearchInput = () => {
      clearTimeout(searchDebounceTimeout)
      searchDebounceTimeout = setTimeout(() => {
        currentPage.value = 1
        fetchArticles()
      }, 400)
    }

    const setQuickSearch = (term) => {
      searchQuery.value = term
      currentPage.value = 1
      fetchArticles()
    }

    const clearSearch = () => {
      searchQuery.value = ''
      currentPage.value = 1
      fetchArticles()
    }

    const goToPage = (page) => {
      if (page >= 1 && page <= lastPage.value) {
        currentPage.value = page
        fetchArticles()
        // Rola suave até a seção de notícias
        const listSection = document.querySelector('.news-list-section')
        if (listSection) {
          listSection.scrollIntoView({ behavior: 'smooth' })
        }
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

    // Calcula páginas visíveis com reticências
    const visiblePages = computed(() => {
      const pages = []
      const delta = 2
      
      for (let i = 1; i <= lastPage.value; i++) {
        if (
          i === 1 ||
          i === lastPage.value ||
          (i >= currentPage.value - delta && i <= currentPage.value + delta)
        ) {
          pages.push(i)
        } else if (pages[pages.length - 1] !== '...') {
          pages.push('...')
        }
      }
      return pages
    })

    return {
      articles,
      currentPage,
      lastPage,
      loading,
      searchQuery,
      visiblePages,
      handleSearchInput,
      setQuickSearch,
      clearSearch,
      goToPage,
      formatDate
    }
  }
}
</script>

<style scoped>
/* ==========================================================================
   HERO DE NOTÍCIAS (DESIGN PREMIUM)
   ========================================================================== */
.news-hero {
  position: relative;
  background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1600&q=80');
  background-size: cover;
  background-position: center;
  height: 50vh;
  min-height: 350px;
  display: flex;
  align-items: center;
  text-align: center;
}

.news-hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, rgba(13, 27, 42, 0.95) 0%, rgba(13, 27, 42, 0.75) 100%);
  z-index: 1;
}

.news-hero-container {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-family: var(--font-serif);
  font-size: 3rem;
  font-weight: 700;
  color: var(--cream);
  margin-bottom: 1rem;
}

.hero-title em {
  font-style: italic;
  color: var(--gold);
}

.hero-sub {
  font-size: 1.1rem;
  color: var(--text-muted);
  max-width: 600px;
  line-height: 1.6;
}

/* ==========================================================================
   FILTROS E BARRA DE BUSCA
   ========================================================================== */
.search-filter-container {
  background: rgba(27, 38, 59, 0.25);
  border: 1px solid rgba(255, 255, 255, 0.03);
  padding: 1.5rem;
  border-radius: 8px;
}

.btn-filter {
  background: transparent;
  color: var(--text-muted);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.5rem 1.2rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 500;
  transition: var(--transition-smooth);
}

.btn-filter:hover {
  border-color: var(--gold);
  color: var(--gold);
}

.btn-filter.active {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--navy-dark);
  font-weight: 600;
}

.search-input-group {
  position: relative;
  display: flex;
  align-items: center;
}

.search-icon {
  position: absolute;
  left: 1rem;
  color: var(--gold);
  font-size: 1rem;
}

.search-field {
  background: rgba(13, 27, 42, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 30px;
  color: var(--cream);
  padding: 0.6rem 2.5rem 0.6rem 2.8rem;
  font-size: 0.9rem;
  width: 100%;
  transition: var(--transition-smooth);
}

.search-field:focus {
  border-color: var(--gold);
  outline: none;
  background: rgba(13, 27, 42, 0.8);
}

.btn-clear {
  position: absolute;
  right: 1rem;
  background: transparent;
  border: none;
  color: var(--text-muted);
  cursor: pointer;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
}

.btn-clear:hover {
  color: var(--gold);
}

/* ==========================================================================
   GRID E CARDS DE NOTÍCIAS
   ========================================================================== */
.news-list-section {
  background-color: var(--navy-dark);
}

.news-grid {
  display: flex;
  flex-wrap: wrap;
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
  line-height: 1.35;
  margin-bottom: 1rem;
  min-height: 2.7rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.news-card-excerpt {
  color: var(--text-muted);
  font-size: 0.9rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 4.3rem;
}

.news-card-link {
  color: var(--gold);
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  display: inline-block;
  transition: var(--transition-smooth);
}

.news-card-link i {
  transition: var(--transition-smooth);
}

.news-card-link:hover {
  color: var(--gold-hover);
}

.news-card-link:hover i {
  transform: translateX(4px);
}

/* Empty State */
.empty-state {
  color: var(--text-muted);
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
  cursor: pointer;
  transition: var(--transition-smooth);
}

.btn-gold:hover {
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  transform: translateY(-1px);
}

/* ==========================================================================
   PAGINAÇÃO PREMIUM
   ========================================================================== */
.pagination-custom {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  gap: 0.4rem;
  align-items: center;
}

.page-link-custom {
  background: rgba(27, 38, 59, 0.4);
  color: var(--text-muted);
  border: 1px solid rgba(255, 255, 255, 0.05);
  width: 40px;
  height: 40px;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 500;
  transition: var(--transition-smooth);
}

.page-link-custom:hover:not(:disabled) {
  border-color: var(--gold);
  color: var(--gold);
  background: rgba(27, 38, 59, 0.7);
}

.page-link-custom:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.page-link-custom.active {
  background: var(--gold);
  color: var(--navy-dark);
  border-color: var(--gold);
  font-weight: 700;
}

.page-link-custom.dots {
  background: transparent;
  border: none;
  cursor: default;
}

.animate-fade-in {
  animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.2rem;
  }
}
</style>
