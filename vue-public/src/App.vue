<template>
  <div class="app-container">
    <!-- Navbar Premium com Efeito Glassmorphism -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top main-navbar">
      <div class="container px-3 px-md-5">
        <router-link to="/" class="navbar-brand py-1">
          <img :src="logoUrl" alt="Logo Cardoso & Bruno" class="nav-logo" />
        </router-link>

        <button 
          class="navbar-toggler" 
          type="button" 
          @click="toggleNav"
          :aria-expanded="isNavOpen" 
          aria-label="Alternar navegação"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" :class="{ 'show': isNavOpen }">
          <ul class="navbar-nav align-items-center gap-3 gap-lg-4 my-3 my-lg-0 me-lg-4">
            <li class="nav-item">
              <router-link to="/#expertise" class="nav-link-custom" @click="closeNav">Áreas de Atuação</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/pagina/direito-civil" class="nav-link-custom" @click="closeNav">Direito Civil</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/pagina/direito-administrativo" class="nav-link-custom" @click="closeNav">Direito Administrativo</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/noticias" class="nav-link-custom" @click="closeNav">Notícias</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/#contato" class="nav-link-custom" @click="closeNav">Contato</router-link>
            </li>
          </ul>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <router-link to="/#contato" class="nav-cta" @click="closeNav">Consulta Inicial</router-link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Transições de Página Fluidas -->
    <main class="main-content">
      <router-view v-slot="{ Component }">
        <transition name="page-fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>

    <!-- Footer Premium e Acessível -->
    <footer class="main-footer">
      <div class="container px-3 px-md-5">
        <div class="row py-5 g-4">
          <div class="col-md-5">
            <img :src="logoUrl" alt="Logo Cardoso & Bruno" class="footer-logo mb-3" />
            <p class="footer-about">
              Compromisso com a integridade, excelência técnica e resolução estratégica de litígios complexos. Advocacia de alto padrão corporativo e civil.
            </p>
          </div>
          <div class="col-md-3">
            <h4 class="footer-title">Links Úteis</h4>
            <ul class="footer-links">
              <li><router-link to="/">Início</router-link></li>
              <li><router-link to="/#expertise">Áreas de Atuação</router-link></li>
              <li><router-link to="/noticias">Notícias</router-link></li>
              <li><router-link to="/#contato">Contato</router-link></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="footer-title">Unidades</h4>
            <address class="footer-address">
              <strong>Belo Horizonte / MG</strong><br />
              Rua Roberto Lúcio Aroeira, 417, Sala 01<br />
              Bairro Itapoã — CEP 31710-055<br />
              <abbr title="Telefone">Tel:</abbr> (31) 9.9224-6996
            </address>
          </div>
        </div>
        
        <div class="footer-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
          <p class="mb-0">&copy; {{ currentYear }} Cardoso & Bruno Sociedade de Advogados. Todos os direitos reservados.</p>
          <a :href="adminUrl" class="admin-login-link mt-2 mt-md-0" title="Acessar o Painel Administrativo">
            <i class="bi bi-shield-lock"></i> Painel Administrativo
          </a>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { ref, computed } from 'vue'

export default {
  name: 'App',
  setup() {
    const isNavOpen = ref(false)
    const currentYear = computed(() => new Date().getFullYear())
    
    const logoUrl = computed(() => {
      const base = window.BASE_URL || '/'
      return `${base.replace(/\/$/, '')}/public/dist/imgs/logo.png`
    })

    const adminUrl = computed(() => {
      const base = window.BASE_URL || '/'
      return `${base.replace(/\/$/, '')}/admin`
    })

    const toggleNav = () => {
      isNavOpen.value = !isNavOpen.value
    }

    const closeNav = () => {
      isNavOpen.value = false
    }

    return {
      isNavOpen,
      currentYear,
      logoUrl,
      adminUrl,
      toggleNav,
      closeNav
    }
  }
}
</script>

<style>
/* ==========================================================================
   SISTEMA DE DESIGN E VARIÁVEIS GLOBAIS
   ========================================================================== */
:root {
  --navy-dark: #0D1B2A;
  --navy-medium: #1B263B;
  --navy-light: #415A77;
  --cream: #FAF9F6;
  --cream-dark: #F0EDE6;
  --gold: #C9A84C;
  --gold-hover: #E5C365;
  --gold-deep: #B08E35;
  --text-primary: #FAF9F6;
  --text-muted: #CBD5E1;
  --text-dark: #1E293B;
  --font-serif: 'Cormorant Garamond', serif;
  --font-sans: 'Outfit', 'Montserrat', sans-serif;
  --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  --glass-bg: rgba(13, 27, 42, 0.85);
  --glass-border: rgba(201, 168, 76, 0.18);
}

/* Reset e Estilos de Base */
body {
  margin: 0;
  padding: 0;
  font-family: var(--font-sans);
  background-color: var(--navy-dark);
  color: var(--text-primary);
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
}

.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.main-content {
  flex-grow: 1;
  padding-top: 86px; /* Altura da navbar para não sobrepor */
  min-height: calc(100vh - 86px - 300px);
}

/* ==========================================================================
   NAVBAR PREMIUM WITH GLASSMORPHISM
   ========================================================================== */
.main-navbar {
  background: var(--glass-bg);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--glass-border);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
  transition: var(--transition-smooth);
  z-index: 1040;
}

.nav-logo {
  max-height: 65px;
  width: auto;
  object-fit: contain;
  transition: var(--transition-smooth);
}

.nav-logo:hover {
  transform: scale(1.02);
}

.nav-link-custom {
  font-family: var(--font-sans);
  font-size: 0.95rem;
  font-weight: 500;
  color: var(--text-muted);
  text-decoration: none;
  position: relative;
  padding: 0.5rem 0;
  letter-spacing: 0.05em;
  transition: var(--transition-smooth);
}

.nav-link-custom:hover {
  color: var(--gold);
}

.nav-link-custom::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--gold);
  transition: var(--transition-smooth);
}

.nav-link-custom:hover::after {
  width: 100%;
}

.router-link-active.nav-link-custom {
  color: var(--gold);
}

.router-link-active.nav-link-custom::after {
  width: 100%;
}

.nav-cta {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark) !important;
  font-weight: 600;
  padding: 0.7rem 1.8rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.9rem;
  letter-spacing: 0.05em;
  border: 1px solid transparent;
  box-shadow: 0 4px 15px rgba(201, 168, 76, 0.25);
  transition: var(--transition-smooth);
}

.nav-cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(201, 168, 76, 0.4);
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  color: var(--navy-dark) !important;
}

/* ==========================================================================
   ACESSIBILIDADE E FOCUS VISIBLE
   ========================================================================== */
a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
  outline: 2px solid var(--gold) !important;
  outline-offset: 3px !important;
}

/* ==========================================================================
   TRANSITIONS DE PÁGINA
   ========================================================================== */
.page-fade-enter-active,
.page-fade-leave-active {
  transition: opacity 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.page-fade-enter-from,
.page-fade-leave-to {
  opacity: 0;
}

/* ==========================================================================
   FOOTER PREMIUM
   ========================================================================== */
.main-footer {
  background-color: #08101A;
  border-top: 1px solid var(--glass-border);
  font-size: 0.95rem;
  color: var(--text-muted);
}

.footer-logo {
  max-height: 80px;
  object-fit: contain;
}

.footer-about {
  line-height: 1.7;
}

.footer-title {
  font-family: var(--font-serif);
  color: var(--gold);
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  position: relative;
  padding-bottom: 0.5rem;
}

.footer-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 40px;
  height: 2px;
  background-color: var(--gold);
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: 0.75rem;
}

.footer-links a {
  color: var(--text-muted);
  text-decoration: none;
  transition: var(--transition-smooth);
}

.footer-links a:hover {
  color: var(--gold);
  padding-left: 5px;
}

.footer-address {
  font-style: normal;
  line-height: 1.7;
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.05);
  font-size: 0.85rem;
}

.admin-login-link {
  color: var(--gold);
  text-decoration: none;
  padding: 0.3rem 0.8rem;
  border: 1px solid var(--gold);
  border-radius: 4px;
  transition: var(--transition-smooth);
}

.admin-login-link:hover {
  background: var(--gold);
  color: var(--navy-dark);
}

/* ==========================================================================
   COMPONENTES E UTILITÁRIOS GLOBAIS
   ========================================================================== */
.gold-line {
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  width: 100%;
}

.section-eyebrow {
  font-family: var(--font-sans);
  color: var(--gold);
  text-transform: uppercase;
  letter-spacing: 0.15em;
  font-size: 0.85rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
  display: inline-block;
}

.section-title {
  font-family: var(--font-serif);
  font-size: 2.5rem;
  font-weight: 600;
  letter-spacing: -0.01em;
  color: var(--cream);
  margin-bottom: 2rem;
}

/* Scrollbar Customizada */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: var(--navy-dark);
}

::-webkit-scrollbar-thumb {
  background: var(--navy-medium);
  border-radius: 5px;
  border: 2px solid var(--navy-dark);
}

::-webkit-scrollbar-thumb:hover {
  background: var(--navy-light);
}

@media (max-width: 991px) {
  .main-navbar .navbar-collapse {
    background: rgba(13, 27, 42, 0.98);
    margin: 0 -1.5rem;
    padding: 1.5rem;
    border-bottom: 1px solid var(--glass-border);
  }
}
</style>
