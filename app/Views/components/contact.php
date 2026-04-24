    <!-- CONTATO -->
    <section class="contact" id="contato">
        <div class="contact-info">
            <div class="section-eyebrow">Contato</div>
            <h2 class="section-title reveal" style="color:var(--cream);">Inicie sua consulta com especialistas</h2>

            <div class="contact-detail">
                <div class="contact-detail-icon" aria-hidden="true">📍</div>
                <div class="contact-detail-text">
                    <span>Endereço</span>
                    <p>Rua Roberto Lúcio Aroeira, 417, Sala 01<br>Bairro Itapoã — Belo Horizonte / MG</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon" aria-hidden="true">📞</div>
                <div class="contact-detail-text">
                    <span>Telefone / WhatsApp</span>
                    <p>(31) 9.9224-6996</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon" aria-hidden="true">✉</div>
                <div class="contact-detail-text">
                    <span>E-mail</span>
                    <p>contato@cardosoebruno.adv.br</p>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    lancarToast('sucesso', <?= json_encode(session()->getFlashdata('success')) ?>);
                });
            </script>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let errorMsgs = "";
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        errorMsgs += <?= json_encode($error) ?> + "<br>";
                    <?php endforeach; ?>
                    lancarToast('erro', errorMsgs);
                });
            </script>
        <?php endif; ?>

        <form class="contact-form" action="<?= base_url('contact') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome completo <span class="text-danger" aria-hidden="true">*</span></label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(31) 9 0000-0000" autocomplete="tel">
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail <span class="text-danger" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="area">Área de interesse</label>
                <select id="area" name="area">
                    <option value="">Selecione uma especialidade</option>
                    <?php if (isset($areas) && !empty($areas)): ?>
                        <?php foreach ($areas as $a): ?>
                            <option value="<?= esc($a['id']) ?>"><?= esc($a['area_interesse']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="1">Direito Civil</option>
                        <option value="2">Direito Administrativo</option>
                        <option value="3">Contratos</option>
                        <option value="4">Família e Sucessões</option>
                        <option value="5">Advocacia Colaborativa</option>
                        <option value="6">Outro</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mensagem">Descreva brevemente sua situação <span class="text-danger" aria-hidden="true">*</span></label>
                <textarea id="mensagem" name="mensagem" placeholder="Como podemos ajudá-lo?" required></textarea>
            </div>
            <button type="submit" class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </form>
    </section>