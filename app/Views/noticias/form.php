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

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-bold">Categoria</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <?php if (isset($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= esc($category['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="draft">Rascunho</option>
                        <option value="published">Publicado</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 position-relative">
                <label for="summary" class="form-label fw-bold">Resumo / Linha Fina (Summary)</label>
                <textarea name="summary" id="summary" class="form-control" rows="3" maxlength="500" placeholder="Digite um breve resumo da notícia"></textarea>
                <div id="summaryCount" class="text-end small mt-1" style="color: var(--gray);">0 / 500</div>
            </div>

            <!-- Editor de Texto Rico (Rich Text) -->
            <div class="mb-4">
                <label class="form-label fw-bold">Conteúdo da Notícia</label>
                <div class="rich-text-editor">
                    <div class="editor-toolbar">
                        <button type="button" onclick="formatDoc('bold')" title="Negrito" aria-label="Negrito"><i class="bi bi-type-bold"></i></button>
                        <button type="button" onclick="formatDoc('italic')" title="Itálico" aria-label="Itálico"><i class="bi bi-type-italic"></i></button>
                        <button type="button" onclick="formatDoc('underline')" title="Sublinhado" aria-label="Sublinhado"><i class="bi bi-type-underline"></i></button>
                        <button type="button" onclick="formatDoc('strikethrough')" title="Tachado" aria-label="Tachado"><i class="bi bi-type-strikethrough"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('formatBlock', 'H2')" title="Título 2" aria-label="Título 2"><b>H2</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'H3')" title="Título 3" aria-label="Título 3"><b>H3</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'P')" title="Parágrafo" aria-label="Parágrafo"><b>P</b></button>
                        <button type="button" onclick="formatDoc('formatBlock', 'BLOCKQUOTE')" title="Citação" aria-label="Citação"><i class="bi bi-quote"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('justifyLeft')" title="Alinhar à Esquerda" aria-label="Alinhar à Esquerda"><i class="bi bi-text-left"></i></button>
                        <button type="button" onclick="formatDoc('justifyCenter')" title="Centralizar" aria-label="Centralizar"><i class="bi bi-text-center"></i></button>
                        <button type="button" onclick="formatDoc('justifyRight')" title="Alinhar à Direita" aria-label="Alinhar à Direita"><i class="bi bi-text-right"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="formatDoc('insertUnorderedList')" title="Lista com Marcadores" aria-label="Lista com Marcadores"><i class="bi bi-list-ul"></i></button>
                        <button type="button" onclick="formatDoc('insertOrderedList')" title="Lista Numerada" aria-label="Lista Numerada"><i class="bi bi-list-ol"></i></button>

                        <span class="toolbar-divider"></span>

                        <button type="button" onclick="addLink()" title="Inserir Link" aria-label="Inserir Link"><i class="bi bi-link-45deg"></i></button>
                        <button type="button" onclick="formatDoc('unlink')" title="Remover Link" aria-label="Remover Link"><i class="bi bi-link-45deg text-danger" style="text-decoration: line-through;"></i></button>
                        <button type="button" onclick="document.getElementById('editorImageUpload').click()" title="Inserir Imagem no Texto" aria-label="Inserir Imagem no Texto"><i class="bi bi-image"></i></button>
                        <input type="file" id="editorImageUpload" class="d-none" accept="image/*" onchange="insertImage(this)">
                    </div>

                    <div class="editor-content" id="editorContent" contenteditable="true" aria-placeholder="Escreva o conteúdo da notícia aqui..."></div>

                    <!-- Input oculto para armazenar o HTML e enviar no POST -->
                    <input type="hidden" name="content" id="hiddenContent">
                </div>
            </div>

            <div class="row mb-4 mt-4">
                <div class="col-md-5">
                    <label for="meta_title" class="form-label fw-bold">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Título para os Buscadores (Opcional)">
                </div>
                <div class="col-md-7">
                    <label for="meta_description" class="form-label fw-bold">Meta Description (SEO)</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="2" placeholder="Descrição para os Buscadores (Opcional)"></textarea>
                </div>
            </div>

            <div class="mb-4">
                <label for="published_at" class="form-label fw-bold">Data de Publicação</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control w-auto">
                <small class="text-muted">Se deixado em branco e o status for "Publicado", a data e hora atual serão usadas.</small>
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

    // --- Lógica do Contador de Caracteres para o Resumo ---
    const summaryInput = document.getElementById('summary');
    const summaryCount = document.getElementById('summaryCount');

    function updateSummaryCount() {
        const length = summaryInput.value.length;
        summaryCount.textContent = `${length} / 500`;
        summaryCount.style.color = length >= 450 ? '#dc3545' : (length >= 400 ? '#ffc107' : 'var(--gray)');
    }

    summaryInput.addEventListener('input', updateSummaryCount);
    updateSummaryCount(); // Inicializa

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