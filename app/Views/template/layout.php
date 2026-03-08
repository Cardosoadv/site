<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= env('GOOGLE_ANALYTICS_ID') ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', '<?= env('GOOGLE_ANALYTICS_ID') ?>');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardoso & Bruno — Advocacia</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/favicon.ico'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/dist/css/style.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
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