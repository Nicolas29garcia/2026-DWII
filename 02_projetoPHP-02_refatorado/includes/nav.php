<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : System Hub — Layout + Navegação
 * Arquivo    : nav/layout.php (estrutura com navbar)
 * Autor      : Nicolas
 * Data       : [DATA DE HOJE]
 * Descrição  : Estrutura completa de layout com:
 *              - <head> configurado
 *              - Navbar fixa no topo
 *              - Conteúdo dinâmico ($conteudo)
 *
 * Variáveis esperadas:
 *   $titulo_pagina → título da aba
 *   $pagina_atual  → controle do link ativo
 *   $caminho_raiz  → base dos links
 *   $nome_dev      → nome exibido no logo
 *   $conteudo      → HTML da página
 * ════════════════════════════════════════════════════════════
 */

// ── Fallbacks defensivos ─────────────────────────────────────
// Evita erros caso alguma variável não seja definida
$titulo_pagina = $titulo_pagina ?? 'Sistema Acadêmico';
$pagina_atual  = $pagina_atual  ?? '';
$caminho_raiz  = $caminho_raiz  ?? './';
$nome_dev      = $nome_dev      ?? 'NICOLAS';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <!-- ── Metadados básicos ─────────────────────────────── -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título da página (com proteção XSS) -->
    <title><?= htmlspecialchars($titulo_pagina) ?></title>

    <!-- ── Fontes externas (Google Fonts) ───────────────── -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- ── Ícones (Font Awesome) ────────────────────────── -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ── Variáveis de tema ─────────────────────────── */
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --dark: #0f172a;
            --text: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo da página */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);

            /* Espaço para navbar fixa */
            padding-top: 70px;

            color: var(--dark);
        }

        /* ── Navbar fixa ─────────────────────────────── */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .main-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            height: 65px;

            display: flex;
            align-items: center;
        }

        /* Container da navbar */
        .nav-container {
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
            padding: 0 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo */
        .nav-logo {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--dark);
            text-decoration: none;

            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo i {
            color: var(--primary);
            font-size: 1rem;
        }

        /* Lista de links */
        .nav-links {
            display: flex;
            gap: 10px;
            list-style: none;
        }

        /* Links */
        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.2s ease;
        }

        /* Hover */
        .nav-links a:hover {
            color: var(--primary);
            background: #ecfdf5;
        }

        /* Link ativo */
        .nav-links a.active {
            color: var(--primary);
            background: #d1fae5;
        }

        /* ── Container principal ─────────────────────── */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;

            /* Garante altura mínima da tela */
            min-height: calc(100vh - 120px);
        }

        /* ── Responsividade ─────────────────────────── */
        @media (max-width: 768px) {
            .nav-links {
                gap: 5px;
            }

            .nav-links a {
                padding: 6px 8px;
                font-size: 0.8rem;
            }
        }
    </style>

</head>
<body>

<!-- ── Navbar ───────────────────────────────────────────── -->
<header>
    <nav class="main-nav">
        <div class="nav-container">

            <!-- Logo / Nome do sistema -->
            <a href="<?= $caminho_raiz ?>index.php" class="nav-logo">
                <i class="fa-solid fa-code"></i>

                <!-- Proteção contra XSS -->
                <?= htmlspecialchars($nome_dev) ?>
            </a>

            <!-- ── Menu de navegação ───────────────────── -->
            <ul class="nav-links">

                <!-- Hub -->
                <li>
                    <a href="<?= $caminho_raiz ?>index.php"
                       class="<?= ($pagina_atual === 'home') ? 'active' : '' ?>">
                        Hub
                    </a>
                </li>

                <!-- Bio -->
                <li>
                    <a href="<?= $caminho_raiz ?>00_apresentacao/index.html">
                        Bio
                    </a>
                </li>

                <!-- Contato -->
                <li>
                    <a href="<?= $caminho_raiz ?>../02_formularios/contato.php"
                       class="<?= ($pagina_atual === 'contato') ? 'active' : '' ?>">
                        Contato
                    </a>
                </li>

                <!-- Login -->
                <li>
                    <a href="<?= $caminho_raiz ?>04_sessoes/login.php"
                       class="<?= ($pagina_atual === 'login') ? 'active' : '' ?>">
                        Acesso
                    </a>
                </li>

            </ul>

        </div>
    </nav>
</header>

<!-- ── Conteúdo dinâmico ───────────────────────────────── -->
<main class="container">

    <?php
    /*
     * $conteudo permite injetar HTML dinamicamente.
     * Exemplo:
     *   $conteudo = '<h1>Minha página</h1>';
     */
    ?>
    <?= $conteudo ?? '' ?>

</main>

</body>
</html>