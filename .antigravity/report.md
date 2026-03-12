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
> A inserção de imagens deve ser reimplementada no Módulo de Notícias futuramente, aderindo à estrutura rigorosa arquitetônica (Service recebendo e sanitizando a Imagem e lidando com o Resize/Upload para o CDN ou `public/uploads`).
