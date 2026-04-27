<?php
$caminho_raiz = '../';
require_once __DIR__ . '/includes/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE id = :id LIMIT 1");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$tec = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$tec) { header('Location: index.php'); exit; }

$titulo_pagina = $tec['nome'] . " | Catálogo";
$pagina_atual = "catalogo";

function e($valor) { return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8'); }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($titulo_pagina) ?></title>

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
    body { font-family:'Inter',sans-serif; background: var(--bg); margin:0; padding:70px 20px 40px; }
    .container { max-width:800px; margin:0 auto; }
    .link-back { display:inline-block; margin-bottom:20px; color:#3b579d; font-weight:bold; text-decoration:none; }
    .link-back:hover { text-decoration:underline; }
    .card { background:#fff; border:1px solid var(--border); border-radius:8px; padding:20px; box-shadow:0 2px 5px rgba(0,0,0,0.05); }
    .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px; }
    .card-header .title { font-size:1.8rem; color: var(--dark); margin:0; }
    .badge { background: var(--primary); color:#fff; padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:bold; }
    .description { font-size:1rem; color:var(--dark); margin:15px 0; }
    table { width:100%; border-collapse:collapse; margin-top:20px; font-size:0.95rem; }
    table td { padding:10px; border:1px solid var(--border); }
    table tr:nth-child(odd) { background:#f3f4f6; }
</style>

</head>
<body>

<div class="container">

    <a href="index.php" class="link-back">← Voltar ao catálogo</a>

    <div class="card">

        <div class="card-header">
            <h1 class="title"><?= e($tec['nome']) ?></h1>
            <span class="badge"><?= e($tec['categoria']) ?></span>
        </div>

        <p class="description"><?= e($tec['descricao']) ?></p>

        <table>
            <tr>
                <td>ID</td>
                <td><?= e($tec['id']) ?></td>
            </tr>
            <tr>
                <td>Ano de criação</td>
                <td><?= e($tec['ano_criacao']) ?></td>
            </tr>
            <tr>
                <td>Cadastrado em</td>
                <td><?= date('d/m/Y \à\s H:i', strtotime($tec['criado_em'])) ?></td>
            </tr>
        </table>

    </div>
</div>

</body>
</html>