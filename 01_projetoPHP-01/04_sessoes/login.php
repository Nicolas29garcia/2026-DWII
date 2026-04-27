<?php
session_start();

// Redireciona se já estiver logado
if (isset($_SESSION['usuario'])) {
    header('Location: painel.php');
    exit;
}

// Credenciais
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA   = 'dwii2026';

$erro = '';
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('d/m/Y \à\s H:i');
        header('Location: painel.php');
        exit;
    } else {
        $erro = 'Acesso negado. Usuário ou senha inválidos.';
    }
}

$titulo_pagina = 'Acesso Restrito';
$caminho_raiz = '../';
$nome_dev = 'Nicolas';
$pagina_atual = 'login';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($titulo_pagina) ?></title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- CSS interno -->
<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --dark: #0f172a;
        --border: #e2e8f0;
        --text-muted: #64748b;
        --bg: #f8fafc;
        --error: #ef4444;
    }

    body { font-family:'Inter',sans-serif; background: var(--bg); margin:0; padding:70px 20px; }

    .container { max-width: 450px; margin: 0 auto; }

    .form-box { background:#fff; border:1px solid var(--border); border-radius:8px; padding:30px; box-shadow:0 2px 6px rgba(0,0,0,0.05); }

    .form-box h1 { font-size:1.5rem; font-weight:800; margin:0 0 5px; color: var(--dark); }
    .form-box p { font-size:0.9rem; color: var(--text-muted); margin-bottom:20px; }

    .input-group { margin-bottom:15px; display:flex; flex-direction:column; }
    .input-group label { font-size:0.85rem; font-weight:600; margin-bottom:5px; }
    .input-group input { padding:10px 12px; border:1px solid var(--border); border-radius:6px; font-size:0.95rem; }

    .btn { display:block; width:100%; background: var(--primary); color:#fff; border:none; padding:12px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; transition: background 0.2s; }
    .btn:hover { background: var(--primary-dark); }

    .link-back { text-decoration:none; color: var(--text-muted); font-size:0.85rem; font-weight:600; display:block; text-align:center; margin-top:20px; }

    .error-msg { background: #fef2f2; border: 1px solid #fee2e2; color: var(--error); padding:12px; border-radius:8px; margin-bottom:20px; font-size:0.85rem; text-align:center; }
    .error-msg strong { font-weight:600; }

    .form-box .icon { font-size:3rem; margin-bottom:10px; }
    .form-box .header-center { text-align:center; margin-bottom:30px; }
</style>

</head>
<body>

<div class="container">
    <div class="form-box">
        
        <div class="header-center">
            <div class="icon">🔐</div>
            <h1>Área do Desenvolvedor</h1>
            <p>Insira suas credenciais para continuar</p>
        </div>

        <?php if ($erro): ?>
            <div class="error-msg">
                <strong>Erro:</strong> <?= htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" autocomplete="off">
            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="usuario" value="<?= htmlspecialchars($login); ?>" placeholder="Seu username" required>
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">Autenticar Sistema</button>
        </form>

        <a href="../index.php" class="link-back">← Voltar para a Home</a>
    </div>
</div>

</body>
</html>