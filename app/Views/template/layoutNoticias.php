<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?= $this->include('components/header') ?>
    <?= $this->renderSection('header') ?>
</head>

<body class="news-body">

    <?= $this->include('components/nav') ?>

    <main class="page-content">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('components/footer') ?>
    <?= $this->renderSection('modals') ?>
    <script src="<?= base_url('public/dist/js/main.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>

</body>

</html>