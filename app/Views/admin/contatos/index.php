<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: var(--gold, #d4af37);">Gerenciar Contatos</h2>
        <a href="<?= base_url('admin/') ?>" class="btn btn-outline-light">
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

    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Área</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contacts)): ?>
                    <?php foreach ($contacts as $item): ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['email']) ?></td>
                            <td><?= esc($item['phone'] ?? '-') ?></td>
                            <td><?= esc($item['area_name'] ?? 'Não Informado') ?></td>
                            <td>
                                <?php 
                                    $badgeClass = 'bg-secondary';
                                    $statusLabel = 'Novo';
                                    switch($item['status']) {
                                        case 'new': $badgeClass = 'bg-info text-dark'; $statusLabel = 'Novo'; break;
                                        case 'contacted': $badgeClass = 'bg-primary'; $statusLabel = 'Contatado'; break;
                                        case 'qualified': $badgeClass = 'bg-warning text-dark'; $statusLabel = 'Qualificado'; break;
                                        case 'converted': $badgeClass = 'bg-success'; $statusLabel = 'Convertido'; break;
                                        case 'lost': $badgeClass = 'bg-danger'; $statusLabel = 'Perdido'; break;
                                    }
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= esc($statusLabel) ?></span>
                            </td>
                            <td>
                                <?= !empty($item['created_at']) ? date('d/m/Y H:i', strtotime($item['created_at'])) : '-' ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/contatos/show/' . esc($item['id'])) ?>" class="btn btn-sm btn-outline-light me-2" title="Ver Detalhes">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/contatos/destroy/' . esc($item['id'])) ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este contato?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Ainda não há contatos cadastrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
