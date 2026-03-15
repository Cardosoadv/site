<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .dashboard-card {
        background-color: #2c2c2c;
        border: 1px solid #444;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        text-decoration: none;
        color: inherit;
        display: block;
        min-height: 150px;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.3);
        border-color: var(--gold, #d4af37);
        color: inherit;
    }

    .dashboard-icon {
        font-size: 3rem;
        color: var(--gold, #d4af37);
        margin-bottom: 15px;
    }

    .dashboard-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="mb-5">
        <h2 style="color: var(--gold, #d4af37);">Painel Administrativo</h2>
        <p class="text-secondary">Selecione o módulo que deseja gerenciar.</p>
    </div>

    <div class="row g-4">
        <!-- Notícias Card -->
        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('admin/noticias') ?>" class="card dashboard-card h-100 text-center p-4">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-newspaper dashboard-icon"></i>
                    <h3 class="dashboard-title text-light">Gerenciar Notícias</h3>
                    <p class="text-secondary mt-2 mb-0 small">Criar, editar e excluir publicações do blog</p>
                </div>
            </a>
        </div>

        <!-- Contatos Card -->
        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('admin/contatos') ?>" class="card dashboard-card h-100 text-center p-4">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-people dashboard-icon"></i>
                    <h3 class="dashboard-title text-light">Gerenciar Contatos</h3>
                    <p class="text-secondary mt-2 mb-0 small">Visualizar leads do site e atualizar status</p>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
