<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: var(--gold, #d4af37);">Detalhes do Contato</h2>
        <a href="<?= base_url('admin/contatos') ?>" class="btn btn-outline-light">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card bg-dark text-light mb-4" style="border: 1px solid #333;">
        <div class="card-header" style="border-bottom: 1px solid #333;">
            <h5 class="mb-0">Informações de <?= esc($contact['name']) ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Email:</strong> <a href="mailto:<?= esc($contact['email']) ?>" class="text-light"><?= esc($contact['email']) ?></a>
                </div>
                <div class="col-md-6">
                    <strong>Telefone:</strong> <?= esc($contact['phone'] ?? 'Não informado') ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Área de Interesse:</strong> <?= esc($contact['area_name'] ?? 'Não Informado') ?>
                </div>
                <div class="col-md-6">
                    <strong>Data de Recebimento:</strong> <?= !empty($contact['created_at']) ? date('d/m/Y H:i:s', strtotime($contact['created_at'])) : '-' ?>
                </div>
            </div>
            
            <hr style="border-color: #444;">
            
            <div class="mb-3">
                <strong>Mensagem:</strong>
                <div class="p-3 mt-2 bg-secondary text-white rounded" style="background-color: #2c2c2c !important;">
                    <?= nl2br(esc($contact['message'])) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Atualização de Status Form -->
    <div class="card bg-dark text-light" style="border: 1px solid #333;">
        <div class="card-header" style="border-bottom: 1px solid #333;">
            <h5 class="mb-0">Atualizar Status CRM</h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/contatos/updateStatus/' . esc($contact['id'])) ?>" method="post" class="d-flex align-items-center gap-3">
                <?= csrf_field() ?>
                <div class="form-group mb-0">
                    <select name="status" id="status" class="form-select bg-dark text-light border-secondary">
                        <option value="new" <?= ($contact['status'] ?? '') == 'new' ? 'selected' : '' ?>>Novo</option>
                        <option value="contacted" <?= ($contact['status'] ?? '') == 'contacted' ? 'selected' : '' ?>>Contatado</option>
                        <option value="qualified" <?= ($contact['status'] ?? '') == 'qualified' ? 'selected' : '' ?>>Qualificado</option>
                        <option value="converted" <?= ($contact['status'] ?? '') == 'converted' ? 'selected' : '' ?>>Convertido</option>
                        <option value="lost" <?= ($contact['status'] ?? '') == 'lost' ? 'selected' : '' ?>>Perdido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: var(--gold, #d4af37); border: none;">
                    Atualizar Status
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
