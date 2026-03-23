<?php
/**
 * -------------------------------------------------------------
 * ARQUIVO : 02_formularios/contato.php
 * Versão : Nicolas - Clean & Secure Form
 * Conceitos : Validação de e-mail, Array de Erros Nomeado, UX
 * -------------------------------------------------------------
 */

// — CONFIGURAÇÕES DE AMBIENTE
$nome_dev = "Nicolas";
$titulo_pagina = "Contato | Dev Space";
$caminho_raiz = "../";

// — ESTADO DOS CAMPOS
$dados = [
    'nome' => '',
    'email' => '',
    'mensagem' => ''
];
$erros = [];

// — PROCESSAMENTO DO FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitização básica
    foreach ($dados as $campo => $valor) {
        $dados[$campo] = trim($_POST[$campo] ?? '');
    }

    // VALIDAÇÕES ESPECÍFICAS
    if (empty($dados['nome'])) {
        $erros['nome'] = "Identifique-se, por favor.";
    }

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "O e-mail informado não parece válido.";
    }

    if (strlen($dados['mensagem']) < 15) {
        $erros['mensagem'] = "Seja mais específico (mínimo 15 caracteres).";
    }

    // SE ESTIVER TUDO OK -> REDIRECIONA (PRG Pattern)
    if (empty($erros)) {
        $query = http_build_query(['status' => 'success', 'user' => $dados['nome']]);
        header("Location: obrigado.php?$query");
        exit;
    }
}
?>

<?php include '../includes/cabecalho.php'; ?>

<style>
    .form-box { max-width: 500px; margin: 40px auto; font-family: 'Inter', sans-serif; }
    .input-group { margin-bottom: 20px; }
    .input-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #334155; }
    
    .input-group input, .input-group textarea {
        width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;
        transition: border-color 0.2s; font-size: 1rem;
    }

    .input-group input:focus { border-color: #10b981; outline: none; }
    .error-msg { color: #ef4444; font-size: 0.85rem; margin-top: 5px; }
    
    .btn-send {
        background: #10b981; color: white; border: none; padding: 12px 24px;
        border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%;
        transition: background 0.2s;
    }
    .btn-send:hover { background: #059669; }
</style>

<div class="container">
    <div class="form-box">
        <h1 style="margin-bottom: 10px;">📩 Enviar Mensagem</h1>
        <p style="color: #64748b; margin-bottom: 30px;">Dúvidas ou feedbacks? Manda um sinal.</p>

        <form action="contato.php" method="POST" novalidate>
            
            <div class="input-group">
                <label>Seu Nome</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" placeholder="Ex: Nicolas Silva">
                <?php if (isset($erros['nome'])): ?>
                    <p class="error-msg"><?= $erros['nome'] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label>E-mail Profissional</label>
                <input type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" placeholder="nicolas@exemplo.com">
                <?php if (isset($erros['email'])): ?>
                    <p class="error-msg"><?= $erros['email'] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label>Sua Mensagem</label>
                <textarea name="mensagem" rows="4" placeholder="Como posso ajudar?"><?= htmlspecialchars($dados['mensagem']) ?></textarea>
                <?php if (isset($erros['mensagem'])): ?>
                    <p class="error-msg"><?= $erros['mensagem'] ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-send">Disparar Mensagem →</button>

        </form>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>