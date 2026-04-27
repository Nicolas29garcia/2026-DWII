<?php
require_once __DIR__ . '/includes/auth.php';
requer_login();

// Variáveis do Template
$nome_dev = "Nicolas";
$titulo_pagina = 'Painel Administrativo';
$caminho_raiz  = '../';
$pagina_atual  = 'painel';
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
    .container { max-width: 1000px; margin: 0 auto; }

    .badge { display:inline-block; padding:4px 12px; border-radius:12px; background: var(--primary); color:#fff; font-size:0.8rem; font-weight:600; }

    h1 { font-weight:800; font-size:2rem; margin-top:10px; color: var(--dark); }
    p { font-size:0.95rem; color: var(--text-muted); }

    .grid-aulas { display:grid; grid-template-columns:1fr; gap:20px; margin-top:20px; }
    @media(min-width:700px){ .grid-aulas { grid-template-columns:1fr 1fr; } }

    .form-box { background:#fff; border:1px solid var(--border); border-radius:8px; padding:20px; box-shadow:0 2px 6px rgba(0,0,0,0.05); }

    .form-box h3 { font-size:1.1rem; margin-bottom:10px; color: var(--dark); display:flex; align-items:center; gap:10px; }
    .form-box p { margin:10px 0; color: var(--text-muted); font-size:0.9rem; }

    .status-box { background: #f8fafc; padding: 15px; border-radius: 8px; font-size: 0.9rem; font-family: monospace; }

    .btn { display:inline-block; background: var(--primary); color:#fff; padding:10px 20px; border-radius:6px; font-weight:600; text-decoration:none; transition: all 0.2s; }
    .btn:hover { background: var(--primary-dark); }

    .btn.logout { background: var(--error); }
    .btn.logout:hover { background: #dc2626; }

</style>
</head>

<body>
<div class="container">

    <div style="margin-bottom: 30px; border-bottom: 1px solid var(--border); padding-bottom: 20px;">
        <span class="badge">Acesso Autorizado</span>
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']); ?>!</h1>
        <p>Sessão iniciada em: <?= htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?></p>
    </div>

    <div class="grid-aulas">
        <div class="form-box" style="border-left: 5px solid var(--primary);">
            <h3><i class="fa-solid fa-chart-line" style="color: var(--primary);"></i> Status do Sistema</h3>
            <p>Este é o seu painel de controle privado. No futuro, aqui você poderá gerenciar os registros do banco de dados (CRUD).</p>
            <div class="status-box">
                > Status: Online <br>
                > Privilégios: Administrador <br>
                > Engine: PHP <?= phpversion(); ?>
            </div>
        </div>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <a href="logout.php" class="btn logout">
            <i class="fa-solid fa-right-from-bracket"></i> Encerrar Sessão
        </a>
    </div>

</div>
</body>
</html>