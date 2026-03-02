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

        <form class="contact-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="contact-name">Nome completo</label>
                    <input id="contact-name" type="text" placeholder="Seu nome" required>
                </div>
                <div class="form-group">
                    <label for="contact-phone">Telefone</label>
                    <input id="contact-phone" type="tel" placeholder="(31) 9 0000-0000">
                </div>
            </div>
            <div class="form-group">
                <label for="contact-email">E-mail</label>
                <input id="contact-email" type="email" placeholder="seu@email.com" required>
            </div>
            <div class="form-group">
                <label for="contact-subject">Área de interesse</label>
                <select id="contact-subject">
                    <option value="">Selecione uma especialidade</option>
                    <option>Direito Civil</option>
                    <option>Direito Administrativo</option>
                    <option>Contratos</option>
                    <option>Família e Sucessões</option>
                    <option>Advocacia Colaborativa</option>
                    <option>Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact-message">Descreva brevemente sua situação</label>
                <textarea id="contact-message" placeholder="Como podemos ajudá-lo?"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </form>
    </section>