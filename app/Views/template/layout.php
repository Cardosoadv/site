<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?= $this->include('components/header') ?>
</head>

<body>

    <?= $this->include('components/nav') ?>

    <?= $this->include('components/hero') ?>

    <div class="gold-line"></div>

    <?= $this->include('components/expertise') ?>

    <?= $this->include('components/pillars') ?>

    <?= $this->include('components/highlights') ?>

    <div class="gold-line"></div>

    <?= $this->include('components/contact') ?>

    <?= $this->include('components/footer') ?>

    <script src="<?= base_url('public/dist/js/main.js') ?>"></script>
</body>

</html>