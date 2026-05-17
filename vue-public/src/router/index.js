import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import NoticiasList from '../views/NoticiasList.vue'
import NoticiasDetail from '../views/NoticiasDetail.vue'
import PaginaCivil from '../views/PaginaCivil.vue'
import PaginaAdministrativo from '../views/PaginaAdministrativo.vue'
import PaginaContratos from '../views/PaginaContratos.vue'
import PaginaColaborativa from '../views/PaginaColaborativa.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/noticias',
    name: 'NoticiasList',
    component: NoticiasList
  },
  {
    path: '/noticias/:slug',
    name: 'NoticiasDetail',
    component: NoticiasDetail
  },
  {
    path: '/pagina/direito-civil',
    name: 'PaginaCivil',
    component: PaginaCivil
  },
  {
    path: '/pagina/direito-administrativo',
    name: 'PaginaAdministrativo',
    component: PaginaAdministrativo
  },
  {
    path: '/pagina/contratos-negocios',
    name: 'PaginaContratos',
    component: PaginaContratos
  },
  {
    path: '/pagina/advocacia-colaborativa',
    name: 'PaginaColaborativa',
    component: PaginaColaborativa
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/'
  }
]

const getRouterBase = () => {
  if (!window.BASE_URL) return '/';
  try {
    const url = new URL(window.BASE_URL);
    return url.pathname;
  } catch (e) {
    return '/';
  }
}

const router = createRouter({
  history: createWebHistory(getRouterBase()),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth'
      }
    }
    return { top: 0, behavior: 'smooth' }
  }
})

export default router
