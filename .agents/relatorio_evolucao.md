# Relatório de Evolução - Projeto Cardoso & Bruno

## [3.8.1] - 2026-05-17
### Corrigido
- Correção no método `generateSitemap()` da classe `SitemapService.php` que estava inicializando incorretamente a variável `$links` com um nível extra de aninhamento de array (`$links[] = [...]`), impossibilitando o funcionamento correto de `createBatch()` e provocando erros no banco de dados e no PHPUnit.
- Classe `SitemapService.php` versionada para `@version 1.0.1`.

### Alterado
- Versão do sistema atualizada para 3.8.1 em `composer.json` e `README.md`.

## [3.8.0] - 2026-05-17
### Adicionado
- Reconfiguração completa da área pública para aplicação **Vue.js 3** de página única (SPA) via **Vite** e **Vue Router**.
- Criação de `ApiController.php` expondo endpoints JSON REST (`/api/areas`, `/api/noticias`, `/api/noticias/(:segment)` e `/api/contact`).
- Implementação de shell de renderização SPA `vue_index.php` com suporte a **SSR-Lite (SEO Dinâmico)** injetando metadados dinamicamente com base nas rotas.
- Integração de formulário de contato via requisições assíncronas AJAX conectadas ao CRM local com suporte a token **CSRF** e alertas Toast responsivos.
- Transições animadas fluidas de mudança de página, design com visual premium, glassmorphism e tipografia refinada (*Cormorant Garamond* e *Outfit*).

### Alterado
- Roteamento em `Routes.php` reconfigurado para suportar o SPA híbrido público sem alterar a área administrativa (`/admin`).
- Controlador principal `Home.php` atualizado para gerenciar a pre-renderização de tags SEO da SPA.
- `vue_index.php` atualizado com carregador de assets híbrido para suportar tanto Apache (`/public` subfolder) quanto Spark (`/public` como root do server).
- `src/router/index.js` corrigido para extrair dinamicamente a pasta base a partir de `window.BASE_URL`, resolvendo duplicação de segmentos na URL.
- Versão do sistema atualizada para 3.8.0 em `composer.json` e `README.md`.

## [3.7.3] - 2026-04-24
### Adicionado
- Inclusão de `title` tag e `meta` tags (description e keywords) dinâmicas em todas as páginas estáticas.
- Implementação de mapeamento de SEO no `Pagina.php` para as áreas de atuação (Direito Civil, Administrativo, Contratos e Advocacia Colaborativa).
- Configuração de SEO padrão para a Home Page no `Home.php`.
- Atualização do componente `header.php` para suportar variáveis de SEO com fallbacks.

### Alterado
- Versão do sistema atualizada para 3.7.3 em `composer.json` e `README.md`.
