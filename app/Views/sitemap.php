<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($sitemap as $url): ?>
    <url>
        <loc><?= esc($url['url']) ?></loc>
        <lastmod><?= $url['last_modified'] ?></lastmod>
        <changefreq><?= $url['changefreq'] ?></changefreq>
        <priority><?= $url['priority'] ?></priority>
    </url>
    <?php endforeach; ?>
</urlset>
