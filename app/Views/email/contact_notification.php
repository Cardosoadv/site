<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; border-bottom: 2px solid #0056b3; }
        .content { padding: 20px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Novo Contato Recebido</h2>
        </div>
        <div class="content">
            <p>Olá,</p>
            <p>Um novo preenchimento foi realizado no formulário de contato do site.</p>
            
            <p><span class="label">Nome:</span> <br><span class="value"><?= esc($contact['name'] ?? 'Não informado') ?></span></p>
            <p><span class="label">E-mail:</span> <br><span class="value"><?= esc($contact['email'] ?? 'Não informado') ?></span></p>
            <p><span class="label">Telefone:</span> <br><span class="value"><?= esc($contact['phone'] ?? 'Não informado') ?></span></p>
            
            <?php if (!empty($areaTitle)): ?>
            <p><span class="label">Área de Interesse:</span> <br><span class="value"><?= esc($areaTitle) ?></span></p>
            <?php endif; ?>

            <p><span class="label">Mensagem:</span></p>
            <div class="value" style="background: #f9f9f9; padding: 15px; border-left: 4px solid #0056b3;">
                <?= nl2br((string) esc($contact['message'] ?? '')) ?>
            </div>
            
            <p><small>Este e-mail foi gerado automaticamente pelo sistema do site.</small></p>
        </div>
    </div>
</body>
</html>
