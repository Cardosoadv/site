<?= $this->extend('template/layoutNoticias') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="mb-4" style="color: var(--gold, #d4af37);"><?= esc($title) ?></h2>

        <form action="<?= base_url('admin/noticias/store') ?>" method="POST" enctype="multipart/form-data" id="newsForm">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="form-label fw-bold">Título da Notícia</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" required placeholder="Digite o título principal">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Imagem em Destaque</label>
                <div class="image-upload-wrapper" id="imageUploadWrapper">
                    <input type="file" name="featured_image" id="featured_image" class="d-none" accept="image/*">

                    <div class="upload-placeholder" id="uploadPlaceholder" onclick="document.getElementById('featured_image').click()">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p class="mb-0 fw-semibold">Clique para fazer upload da imagem</p>
                        <small class="text-muted">JPG, PNG ou WebP (Máx. 2MB)</small>
                    </div>

                    <img id="imagePreview" src="" alt="Vista prévia da imagem" class="d-none img-fluid rounded" style="max-height: 300px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('featured_image').click()" title="Clique para trocar a imagem">
                </div>
            </div>

            <!-- Editor de Texto Rico (Rich Text) -->
            <div class="mb-4">
                <label class="form-label fw-bold">Conteúdo da Notícia</label>
                <div class="rich-text-editor">
                    <div class="editor-toolbar">
                        <button type="button" onclick="formatDoc('bold')" title="Negrito"><i class="bi bi-type-bold"></i></button>
                        <button type="button" onclick="formatDoc('italic')" title="Itálico"><i class="bi bi-type-italic"></i></button>
                        <button type="button" onclick="formatDoc('underline')" title="Sublinhado"><i class="bi bi-type-underline"></i></button>
                        <button type="button" onclick="formatDoc('strikethrough')" title="Tachado"><i class="bi bi-type-strikethrough"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('formatBlock', 'H2')" title="Título 2"><b>H2</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'H3')" title="Título 3"><b>H3</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'P')" title="Parágrafo"><b>P</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'BLOCKQUOTE')" title="Citação"><i class="bi bi-quote"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('justifyLeft')" title="Alinhar à Esquerda"><i class="bi bi-text-left"></i></button>
                        <button type="button" onclick="formatDoc('justifyCenter')" title="Centralizar"><i class="bi bi-text-center"></i></button>
                        <button type="button" onclick="formatDoc('justifyRight')" title="Alinhar à Direita"><i class="bi bi-text-right"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('insertUnorderedList')" title="Lista com Marcadores"><i class="bi bi-list-ul"></i></button>
                        <button type="button" onclick="formatDoc('insertOrderedList')" title="Lista Numerada"><i class="bi bi-list-ol"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="addLink()" title="Inserir Link"><i class="bi bi-link-45deg"></i></button>
                        <button type="button" onclick="formatDoc('unlink')" title="Remover Link"><i class="bi bi-link-45deg text-danger" style="text-decoration: line-through;"></i></button>
                        <button type="button" onclick="document.getElementById('editorImageUpload').click()" title="Inserir Imagem no Texto"><i class="bi bi-image"></i></button>
                        <input type="file" id="editorImageUpload" class="d-none" accept="image/*" onchange="insertImage(this)">
                    </div>

                    <div class="editor-content" id="editorContent" contenteditable="true" aria-placeholder="Escreva o conteúdo da notícia aqui..."></div>

                    <!-- Input oculto para armazenar o HTML e enviar no POST -->
                    <input type="hidden" name="content" id="hiddenContent">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-5">
                <a href="<?= base_url('admin/noticias') ?>" class="btn btn-outline-secondary px-4 py-2">Cancelar</a>
                <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--gold, #d4af37); border: none;">Salvar Notícia</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // --- Lógica de Upload da Imagem em Destaque ---
    const featuredImageInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    featuredImageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                uploadPlaceholder.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
            uploadPlaceholder.classList.remove('d-none');
        }
    });

    // --- Lógica do Editor de Texto Rico (Rich Text Editor) ---
    function formatDoc(cmd, value = null) {
        if (value) {
            document.execCommand(cmd, false, value);
        } else {
            document.execCommand(cmd);
        }
        document.getElementById('editorContent').focus();
    }

    function addLink() {
        const url = prompt('Insira o link (incluindo http:// ou https://):');
        if (url) {
            document.execCommand('createLink', false, url);
        }
    }

    function insertImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Insere a imagem como base64 no editor
                document.execCommand('insertImage', false, e.target.result);
            }
            reader.readAsDataURL(file);
        }
        // Reseta o input para permitir enviar a mesma imagem novamente se necessário
        input.value = '';
    }

    // Sincroniza o conteúdo da div editável com o input hidden antes de enviar o form
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        const editorContent = document.getElementById('editorContent').innerHTML;
        document.getElementById('hiddenContent').value = editorContent;

        // Validação básica
        if (editorContent.trim() === '' || editorContent.trim() === '<br>') {
            e.preventDefault();
            alert('Por favor, insira o conteúdo da notícia.');
            document.getElementById('editorContent').focus();
        }
    });
</script>
<?= $this->endSection() ?>