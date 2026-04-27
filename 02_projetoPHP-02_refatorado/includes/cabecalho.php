<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : System Hub — versão moderna
 * Arquivo    : includes/cabecalho.php
 * Autor      : Nicolas
 * Data       : [DATA DE HOJE]
 * Descrição  : Cabeçalho global do sistema.
 *              Responsabilidades:
 *              1. Gerar estrutura base do HTML (<head>)
 *              2. Importar fontes e bibliotecas externas
 *              3. Definir base de caminhos (base URL)
 *              4. Renderizar a navegação principal (navbar)
 *
 * Variáveis esperadas:
 *   $titulo_pagina → título da aba
 *   $pagina_atual  → controle do menu ativo
 *   $nome_dev      → nome exibido no logo
 * ════════════════════════════════════════════════════════════
 */

// ── Fallbacks defensivos ─────────────────────────────────────
// Garante que o sistema não quebre caso alguma variável
// não tenha sido definida na página que inclui o cabeçalho
$titulo_pagina = $titulo_pagina ?? 'Sistema Nicolas';
$pagina_atual  = $pagina_atual  ?? '';
$nome_dev      = $nome_dev      ?? 'NICOLAS';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <!-- ── Metadados básicos ─────────────────────────────── -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título da página (protegido contra XSS) -->
    <title><?= htmlspecialchars($titulo_pagina) ?></title>

    <!-- ── Base URL ──────────────────────────────────────── -->
    <!--
        Define um caminho base para TODOS os links relativos.
        Evita problemas com caminhos quebrados (../ etc).
        Exemplo:
        href="style.css" → vira /2026-DWII/style.css automaticamente
    -->
    <base href="/2026-DWII/">

    <!-- ── Fontes externas (Google Fonts) ───────────────── -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- ── Ícones (Font Awesome) ────────────────────────── -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- ── CSS global ───────────────────────────────────── -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<!-- ── Navegação principal ───────────────────────────────── -->
<header>
    <nav class="main-nav">
        <div class="nav-container">

            <!-- Logo / Nome do sistema -->
            <a href="index.php" class="nav-logo">
                <i class="fa-solid fa-code"></i>

                <!-- htmlspecialchars protege contra XSS -->
                <span><?= htmlspecialchars($nome_dev) ?></span>
            </a>

            <!-- ── Menu de navegação ─────────────────────── -->
            <ul class="nav-links">

                <!-- Link HUB -->
                <li>
                    <a href="index.php"
                       class="<?= ($pagina_atual === 'home') ? 'active' : '' ?>">
                        Hub
                    </a>
                </li>

                <!-- Página de apresentação -->
                <li>
                    <a href="00_apresentacao/index.html">
                        Bio
                    </a>
                </li>

                <!-- Página de contato -->
                <li>
                    <a href="02_formularios/contato.php"
                       class="<?= ($pagina_atual === 'contato') ? 'active' : '' ?>">
                        Contato
                    </a>
                </li>

                <!-- Login / sessão -->
                <li>
                    <a href="04_sessoes/login.php"
                       class="<?= ($pagina_atual === 'login') ? 'active' : '' ?>">
                        Acesso
                    </a>
                </li>

            </ul>

        </div>
    </nav>
</header>

<!-- ── Conteúdo principal ───────────────────────────────── -->
<main class="container">