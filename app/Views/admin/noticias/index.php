<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: var(--gold, #d4af37);">Gerenciar Notícias</h2>
        <div>
            <a href="<?= base_url('admin/') ?>" class="btn btn-outline-light me-2">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
            <a href="<?= base_url('admin/noticias/create') ?>" class="btn btn-primary" style="background-color: var(--gold, #d4af37); border: none;">
                <i class="bi bi-plus-lg"></i> Nova Notícia
            </a>
        </div>
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
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Data Publicação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                        <tr>
                            <td><?= esc($item['title']) ?></td>
                            <td><?= esc($item['category_name'] ?? 'Sem Categoria') ?></td>
                            <td>
                                <?php if ($item['status'] === 'published'): ?>
                                    <span class="badge bg-success">Publicado</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Rascunho</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= !empty($item['published_at']) ? date('d/m/Y H:i', strtotime($item['published_at'])) : '-' ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/noticias/edit/' . esc($item['slug'])) ?>" class="btn btn-sm btn-outline-light me-2" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('admin/noticias/destroy/' . esc($item['id'])) ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta notícia?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Ainda não há notícias cadastradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
