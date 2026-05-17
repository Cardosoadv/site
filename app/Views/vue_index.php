<?php
// Resolve path Híbrido: se estiver rodando via Spark (document_root terminando em public),
// omitimos o prefixo 'public/'. Caso contrário, mantemos.
$distVueCss = 'public/dist-vue/assets/index.css';
$distVueJs = 'public/dist-vue/assets/index.js';
$logoImg = 'public/dist/imgs/logo.png';
$favicon = 'public/favicon.ico';

if (substr(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), -7) === '/public') {
    $distVueCss = 'dist-vue/assets/index.css';
    $distVueJs = 'dist-vue/assets/index.js';
    $logoImg = 'dist/imgs/logo.png';
    $favicon = 'favicon.ico';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Preconnect e DNS-Prefetch para performance -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Dinâmico (SSR-Lite) -->
    <title><?= esc($title) ?></title>
    <meta name="description" content="<?= esc($metaDescription) ?>">
    <meta name="keywords" content="<?= esc($metaKeywords) ?>">
    
    <!-- Open Graph (Redes Sociais) -->
    <meta property="og:title" content="<?= esc($title) ?>">
    <meta property="og:description" content="<?= esc($metaDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image" content="<?= base_url($logoImg) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url($favicon) ?>">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Montserrat:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons & Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- CSS Compilado do Vue 3 (Vite) -->
    <link rel="stylesheet" href="<?= base_url($distVueCss) ?>">

    <!-- Configurações de Integração SPA e Segurança -->
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="csrf-header" content="<?= csrf_header() ?>">
    <script>
        window.BASE_URL = '<?= base_url() ?>';
        // Injetando as áreas iniciais no window para evitar requisição extra imediata no form de contato
        window.INITIAL_AREAS = <?= json_encode($areas) ?>;
    </script>
</head>
<body>

    <!-- Target Mount do Vue 3 -->
    <div id="app"></div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- JS Compilado do Vue 3 (Vite) -->
    <script type="module" src="<?= base_url($distVueJs) ?>"></script>
</body>
</html>
