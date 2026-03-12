# Cardoso & Bruno Sociedade de Advogados

Este projeto é um site desenvolvido com o framework [CodeIgniter 4](https://codeigniter.com/), contando com uma área pública e um painel administrativo seguro.

## 🚀 Funcionalidades

- **Área Pública**:
  - Página Inicial (`Home`).
  - Listagem e leitura de Notícias publicadas.
  - Formulário de Contato integrado com o banco de dados.
- **Painel Administrativo (`/admin`)**:
  - Acesso restrito para usuários autenticados (utilizando CodeIgniter Shield).
  - Gerenciamento completo de Notícias (Criar, Editar, Excluir).
  - Interface moderna com suporte a um tema escuro (Dark Theme), editor Rich Text para o conteúdo das notícias e upload de imagens.
  - Sistema de alertas e notificações via Toast (JavaScript).

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 8.1+, CodeIgniter 4
- **Banco de Dados**: MySQL
- **Segurança e Autenticação**: CodeIgniter Shield
- **Frontend**: HTML5, CSS3 Customizado, JavaScript puro (Vanilla JS)

## ⚙️ Pré-requisitos

Certifique-se de que o seu ambiente de desenvolvimento atende aos seguintes requisitos:
- **PHP 8.1** ou superior (com as extensões `intl`, `mbstring`, `json`, `mysqlnd` e `libcurl` habilitadas).
- **Composer** (Gerenciador de dependências do PHP).
- **Servidor Web** (XAMPP, Apache, Nginx) ou suporte ao CLI embutido do PHP (`php spark serve`).
- **Banco de Dados** MySQL/MariaDB.

## 📦 Instalação e Configuração

1. **Clonar o Repositório**:
   ```bash
   git clone <caminho-ou-url-do-repositorio>
   cd site
   ```

2. **Instalar Dependências**:
   ```bash
   composer install
   ```

3. **Configuração as Variáveis de Ambiente**:
   - Copie o arquivo de exemplo `env` para gerar o `.env`:
     ```bash
     cp env .env
     ```
   - Abra o `.env` gerado e edite as informações da aplicação e do banco de dados (remover a `#` do início da linha para ativá-las):
     ```env
     CI_ENVIRONMENT = development
     app.baseURL = 'http://localhost/site'

     database.default.hostname = localhost
     database.default.database = site
     database.default.username = seu_usuario
     database.default.password = sua_senha
     database.default.DBDriver = MySQLi
     ```

4. **Rodar as Migrations**:
   Caso existam alterações no banco de dados, rode o script de migrations via linha de comando para subir e atualizar as tabelas do projeto:
   ```bash
   php spark migrate
   ```

5. **Iniciando o Servidor (Opcional)**:
   Se não estiver rodando sob um Apache local tipo XAMPP e desejar rodar usando o Spark:
   ```bash
   php spark serve
   ```
   O projeto estará disponível por padrão em `http://localhost:8080/`.

## 📂 Estrutura do Projeto

- `app/Controllers`: Camada Controller (Controladores públicos e da pasta `admin/`).
- `app/Config`: Diretório de constantes, rotas e demais configurações do CI4.
- `app/Models` & `app/Repositories`: Camadas responsáveis pelas models (ex: `CrmContactModel`, `ProcessosModel`) e Repositórios para gerenciamento das consultas de banco de dados.
- `public/`: Diretório acessível web, abrigando o `index.php`, requisições CSS, JS, e envios de upload de imagens.

## 📄 Licença

Este projeto está registrado sob a licença MIT - consulte o arquivo `LICENSE` no repositório para mais detalhes.
