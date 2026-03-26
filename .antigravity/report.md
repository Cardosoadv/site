# Relatório de Evolução das Refatorações

## 12 de Março de 2026

**Refatoração do Módulo de Notícias para Padrão MVC + Repository + Service**
O módulo de Notícias passou por uma reestruturação severa para aderir estritamente ao padrão de arquitetura definido para o projeto, onde:

1. **Models** abstraem apenas as tabelas. 
2. **Repositories** lidam inteiramente com as interações e operações do banco de dados (herdando de `BaseRepository` e utilizando seu sistema de Cache nativo).
3. **Services** abstraem toda a lógica de negócio (geração automática de slug, link com `author_id` logado e datas de publicação).
4. **Controllers** recebem os Requests HTTP, disparam métodos nos Services, e entregam as Views (e Toasts de erro/sucesso via session flashdata).

### Ponto de Atenção: Funcionalidade de Imagem em Destaque Suspensa
A possibilidade de inserir *Imagens em Destaque* na notícia foi explicitamente **removida/suspensa** neste update. Ela não encontra-se mais definida no `NewsModel`, `NewsRepository` ou na formulário de View.

> **Trabalho Futuro:** 

## 13 de Março de 2026

**Otimização e Correção do Módulo de Sitemap**

Nesta evolução, focamos na estabilidade e performance da geração do sitemap indexável:

1. **Correção de Recursão (Bug Fix)**: Resolvido erro fatal de estouro de memória no `SitemapModel`. O método `truncate()` foi corrigido para utilizar o Database Builder em vez de chamada recursiva.
2. **Ajuste de Interface de Serviço**: Corrigido erro de método inexistente em `SitemapService`. A chamada para o `NewsService` foi migrada de `findAll()` para `getAll()`, respeitando a abstração do `BaseService`.
3. **Implementação de Cache**: Adicionada uma camada de cache de 24 horas para os links do sitemap.
4. **Geração Automática**: O `SitemapService` agora detecta a ausência de cache e dispara a regeneração automática dos links, garantindo que o arquivo `/sitemap.xml` esteja sempre disponível e otimizado.

## 15 de Março de 2026

**Implementação do Módulo de Contatos (Admin) e Dashboard Central**

Nesta evolução, expandimos o painel administrativo (`/admin`) em estrita aderência à arquitetura MVC + Repository + Service preestabelecida:

1. **Gestão de Contatos**: Desenvolvido o controlador `admin\Contatos`, bem como as views de listagem (`index`) e exibição de detalhes (`show`). A camada de dados reaproveita as instâncias existentes `CrmContactModel`, `CrmContactRepository` e `CrmContactService`. O sistema agora permite que a administração visualize mensagens e avance o estágio do chumbo no funil (Novo, Contatado, Qualificado, Convertido, Perdido).
2. **Dashboard de Acesso Central (`/admin`)**: Criada uma *landing page* interna por intermédio do controlador responsável `admin\Dashboard`. Esta interface exibe cards responsivos e estilizados provendo acesso rápido aos submódulos estruturais (Notícias e Contatos).
