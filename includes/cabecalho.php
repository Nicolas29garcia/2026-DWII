<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo_pagina ?? 'Sistema Nicolas') ?></title>

    <!-- Base URL (resolve TODOS os caminhos) -->
    <base href="/2026-DWII/">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav class="main-nav">
        <div class="nav-container">

            <!-- Logo -->
            <a href="index.php" class="nav-logo">
                <i class="fa-solid fa-code"></i>
                <span><?= htmlspecialchars($nome_dev ?? 'NICOLAS') ?></span>
            </a>

            <!-- Menu -->
            <ul class="nav-links">
                <li>
                    <a href="index.php"
                       class="<?= ($pagina_atual ?? '') === 'home' ? 'active' : '' ?>">
                        Hub
                    </a>
                </li>

                <li>
                    <a href="00_apresentacao/index.html">
                        Bio
                    </a>
                </li>

                <li>
                    <a href="02_formularios/contato.php"
                       class="<?= ($pagina_atual ?? '') === 'contato' ? 'active' : '' ?>">
                        Contato
                    </a>
                </li>

                <li>
                    <a href="04_sessoes/login.php"
                       class="<?= ($pagina_atual ?? '') === 'login' ? 'active' : '' ?>">
                        Acesso
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</header>

<main class="container">