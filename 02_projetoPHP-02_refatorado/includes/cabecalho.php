<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : System Hub — versão moderna
 * Arquivo    : includes/cabecalho.php
 * Autor      : Nicolas Henrique
 * Data       : [DATA DE HOJE]
 * Descrição  : Cabeçalho global do sistema.
 *
 * Responsabilidades:
 *  1. Gerar estrutura base do HTML
 *  2. Importar fontes e bibliotecas externas
 *  3. Carregar CSS global
 *  4. Renderizar navbar principal
 *  5. Controlar menu ativo
 *  6. Gerenciar caminhos dinâmicos
 * ════════════════════════════════════════════════════════════
 */

// ── Fallbacks defensivos ──────────────────────────────────
// Evita erros caso alguma variável não seja definida
// antes de incluir o cabeçalho.

$titulo_pagina = $titulo_pagina ?? 'System Hub';
$pagina_atual  = $pagina_atual  ?? '';
$nome_dev      = $nome_dev      ?? 'NICOLAS';
$caminho_raiz  = $caminho_raiz  ?? './';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <!-- ── Metadados básicos ───────────────────────────── -->
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <!-- ── Título da página ────────────────────────────── -->
    <!-- htmlspecialchars evita XSS -->
    <title>
        <?= htmlspecialchars($titulo_pagina) ?>
    </title>

    <!-- ── Google Fonts ───────────────────────────────── -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap"
          rel="stylesheet">

    <!-- ── Font Awesome ───────────────────────────────── -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- ── CSS Global ─────────────────────────────────── -->
    <!--
        Caminho dinâmico:
        Funciona em qualquer pasta do projeto.
    -->
    <link rel="stylesheet"
          href="<?= $caminho_raiz ?>includes/style.css">

</head>

<body>

<!-- ───────────────────────────────────────────────────────
     Navbar principal
─────────────────────────────────────────────────────── -->

<header>

    <nav class="main-nav">

        <div class="nav-container">

            <!-- ── Logo sistema ───────────────────────── -->
            <a href="<?= $caminho_raiz ?>index.php"
               class="nav-logo">

                <i class="fa-solid fa-code"></i>

                <span>
                    <?= htmlspecialchars($nome_dev) ?>
                </span>

            </a>

            <!-- ── Links navegação ────────────────────── -->
            <ul class="nav-links">

                <!-- HUB -->
                <li>

                    <a href="<?= $caminho_raiz ?>index.php"
                       class="<?= ($pagina_atual === 'home') ? 'active' : '' ?>">

                        Hub

                    </a>

                </li>

            </ul>

        </div>

    </nav>

</header>

<!-- ───────────────────────────────────────────────────────
     Conteúdo principal
─────────────────────────────────────────────────────── -->

<main class="container">