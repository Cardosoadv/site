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
                    <label for="nome">Nome completo <span aria-hidden="true" style="color:red">*</span></label>
                    <input id="nome" name="nome" type="text" placeholder="Seu nome" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone <span aria-hidden="true" style="color:red">*</span></label>
                    <input id="telefone" name="telefone" type="tel" placeholder="(31) 9 0000-0000" required autocomplete="tel">
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail <span aria-hidden="true" style="color:red">*</span></label>
                <input id="email" name="email" type="email" placeholder="seu@email.com" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="area_interesse">Área de interesse</label>
                <select id="area_interesse" name="area_interesse">
                    <option value="">Selecione uma especialidade</option>
                    <option value="Direito Civil">Direito Civil</option>
                    <option value="Direito Administrativo">Direito Administrativo</option>
                    <option value="Contratos">Contratos</option>
                    <option value="Família e Sucessões">Família e Sucessões</option>
                    <option value="Advocacia Colaborativa">Advocacia Colaborativa</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mensagem">Descreva brevemente sua situação</label>
                <textarea id="mensagem" name="mensagem" placeholder="Como podemos ajudá-lo?"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="align-self:flex-start; padding: 1rem 2.5rem;">Enviar Consulta</button>
        </form>
    </section>