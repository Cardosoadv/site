    <!-- NAV -->
    <nav>
        <div class="logo">
            <img src="<?= base_url('public/dist/imgs/logo.png'); ?>" alt="Logo Cardoso & Bruno" style="max-height: 70px; width: auto; object-fit: contain;">
        </div>
        <ul class="nav-links">
            <li><a href="<?= base_url() ?>#expertise">Áreas de Atuação</a></li>
            <li><a href="<?= base_url() ?>#civil">Direito Civil</a></li>
            <li><a href="<?= base_url() ?>#administrativo">Direito Administrativo</a></li>
            <li><a href="<?= base_url() ?>#contato">Contato</a></li>
            <li>
                <a href="<?= base_url() ?>#noticias">Notícias</a>
            </li>
        </ul>
        <button class="nav-cta" onclick="document.getElementById('contato').scrollIntoView({behavior:'smooth'})" aria-label="Agendar consulta inicial">Consulta Inicial</button>
    </nav>