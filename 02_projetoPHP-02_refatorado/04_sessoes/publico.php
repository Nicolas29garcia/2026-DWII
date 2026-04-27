<?php
session_start(); 

$logado = isset($_SESSION['usuario']);

$nome_dev = "Nicolas";
$titulo_pagina = 'Página Pública';
$caminho_raiz  = '../';
$pagina_atual  = 'publico';
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

<!-- CSS Interno -->
<style>
:root {
    --primary: #10b981;
    --primary-dark: #059669;
    --dark: #0f172a;
    --border: #e2e8f0;
    --text-muted: #64748b;
    --bg: #f8fafc;
    --error: #ef4444;
    --text-main: #1e293b;
}

body { font-family:'Inter',sans-serif; background: var(--bg); margin:0; padding:70px 20px; }
.container { max-width: 700px; margin: 0 auto; text-align:center; }

.badge { display:inline-block; padding:4px 12px; border-radius:12px; background:#e0f2fe; color:#0ea5e9; font-weight:600; font-size:0.85rem; }

h1 { font-size:2.5rem; font-weight:800; margin-top:15px; color: var(--dark); }
h2 { font-size:1.8rem; font-weight:700; color: var(--dark); }
p { color: var(--text-muted); font-size:1rem; margin:10px 0 20px; }

.form-box { background:#fff; padding:40px; border-radius:16px; box-shadow:0 2px 6px rgba(0,0,0,0.05); margin-bottom:20px; }

.btn { display:inline-block; background: var(--primary); color:#fff; padding:10px 20px; border-radius:6px; font-weight:600; text-decoration:none; transition: all 0.2s; }
.btn:hover { background: var(--primary-dark); }

.link-back { display:inline-block; margin-top:20px; color: var(--text-muted); font-size:0.9rem; font-weight:600; text-decoration:none; }
.link-back:hover { text-decoration:underline; }

.icon-large { font-size:3rem; margin-bottom:10px; display:block; }
</style>
</head>

<body>

<div class="container">

    <div style="margin-bottom: 40px;">
        <span class="badge">Acesso Livre</span>
        <h1>🌐 Conteúdo Público</h1>
        <p>Esta seção do sistema está aberta para todos os visitantes da web. Nenhum protocolo de segurança é exigido aqui.</p>
    </div>

    <div class="form-box">
        <?php if ($logado): ?>
            <span class="icon-large">👋</span>
            <h2>Olá, <?= htmlspecialchars($_SESSION['usuario']); ?>!</h2>
            <p>Detectamos que sua sessão de desenvolvedor ainda está ativa.</p>
            <a href="painel.php" class="btn">
                <i class="fa-solid fa-gauge-high"></i> Voltar ao Painel
            </a>

        <?php else: ?>
            <span class="icon-large">🔒</span>
            <h2>Área Restrita</h2>
            <p>Algumas funcionalidades deste repositório exigem autenticação prévia.</p>
            <a href="login.php" class="btn">
                <i class="fa-solid fa-key"></i> Acessar Sistema
            </a>
        <?php endif; ?>
    </div>

    <a href="../index.php" class="link-back">← Retornar ao Hub Principal</a>

</div>

</body>
</html>