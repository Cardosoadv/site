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
                    <label for="nome">Nome completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(31) 9 0000-0000" autocomplete="tel">
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="area">Área de interesse</label>
                <select id="area" name="area">
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
                <label for="mensagem">Descreva brevemente sua situação</label>
                <textarea id="mensagem" name="mensagem" placeholder="Como podemos ajudá-lo?" required></textarea>
            </div>
            <button type="submit" class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </form>
    </section>