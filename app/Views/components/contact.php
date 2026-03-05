    <!-- CONTATO -->
    <section class="contact" id="contato">
        <div class="contact-info">
            <div class="section-eyebrow">Contato</div>
            <h2 class="section-title reveal" style="color:var(--cream);">Inicie sua consulta com especialistas</h2>

            <div class="contact-detail">
                <div class="contact-detail-icon">📍</div>
                <div class="contact-detail-text">
                    <span>Endereço</span>
                    <p>Rua Roberto Lúcio Aroeira, 417, Sala 01<br>Bairro Itapoã — Belo Horizonte / MG</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon">📞</div>
                <div class="contact-detail-text">
                    <span>Telefone / WhatsApp</span>
                    <p>(31) 9.9224-6996</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-detail-icon">✉</div>
                <div class="contact-detail-text">
                    <span>E-mail</span>
                    <p>contato@cardosoebruno.adv.br</p>
                </div>
            </div>
        </div>

        <form class="contact-form" action="#" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome completo <span class="text-red-500" aria-hidden="true">*</span></label>
                    <input id="nome" name="nome" type="text" placeholder="Seu nome" required aria-required="true">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" type="tel" placeholder="(31) 9 0000-0000">
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail <span class="text-red-500" aria-hidden="true">*</span></label>
                <input id="email" name="email" type="email" placeholder="seu@email.com" required aria-required="true">
            </div>
            <div class="form-group">
                <label for="area">Área de interesse <span class="text-red-500" aria-hidden="true">*</span></label>
                <select id="area" name="area" required aria-required="true">
                    <option value="">Selecione uma especialidade</option>
                    <option value="direito-civil">Direito Civil</option>
                    <option value="direito-administrativo">Direito Administrativo</option>
                    <option value="contratos">Contratos</option>
                    <option value="familia-e-sucessoes">Família e Sucessões</option>
                    <option value="advocacia-colaborativa">Advocacia Colaborativa</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mensagem">Descreva brevemente sua situação <span class="text-red-500" aria-hidden="true">*</span></label>
                <textarea id="mensagem" name="mensagem" placeholder="Como podemos ajudá-lo?" required aria-required="true"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </form>
    </section>