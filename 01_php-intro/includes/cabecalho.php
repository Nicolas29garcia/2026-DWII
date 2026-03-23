<?php
// Configurações padrão caso não venham da página principal
if (!isset($titulo_pagina)) $titulo_pagina = "Portfólio DWII";
if (!isset($caminho_raiz)) $caminho_raiz = "../";
if (!isset($nome_dev)) $nome_dev = "Nicolas Henrique";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo $caminho_raiz; ?>style.css">
</head>
<body>

    <header class="main-nav">
        <div class="nav-container">
            <a href="<?php echo $caminho_raiz; ?>index.php" class="nav-logo">
                <i class="fa-solid fa-code"></i>
                <span><?php echo strtoupper($nome_dev); ?></span>
            </a>

            <?php include __DIR__ . '/nav.php'; ?>
        </div>
    </header>

    <main class="container">