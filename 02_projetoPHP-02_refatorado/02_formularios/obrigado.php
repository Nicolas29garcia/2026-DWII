<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : obrigado.php
 * ============================================================
 */

// Inicia sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variáveis padrão
$pagina_atual  = 'contato';
$titulo_pagina = 'Mensagem enviada | Portfólio DWII';
$caminho_raiz  = '../'; // 👈 IMPORTANTE (subindo uma pasta)

// Pega o nome da sessão
$nome_visitante = $_SESSION['contato_nome'] ?? null;

// Bloqueia acesso direto
if ($nome_visitante === null) {
    header('Location: contato.php');
    exit;
}

// Remove da sessão
unset($_SESSION['contato_nome']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include __DIR__ . '/../includes/cabecalho.php'; ?>
</head>

<body>
<div class="container">

    <div class="alerta-sucesso">
        <h3>Mensagem enviada com sucesso!</h3>

        <p>
            Obrigado,
            <strong><?= htmlspecialchars($nome_visitante) ?></strong>!
        </p>

        <p>Sua mensagem foi recebida. Retornarei em breve.</p>
    </div>

    <div style="margin-top: 20px; display: flex; gap: 12px;">
        <a href="<?= $caminho_raiz ?>index.php" class="btn-primario">
            Voltar ao Início
        </a>

        <a href="contato.php" class="btn-secundario">
            Enviar outra mensagem
        </a>
    </div>

</div>

<?php include __DIR__ . '/../includes/rodape.php'; ?>

</body>
</html>