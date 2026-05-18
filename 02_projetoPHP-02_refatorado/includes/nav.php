<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal
 * Arquivo    : includes/nav.php
 * Autor      : Nicolas Henrique
 * Descrição  : Menu principal com links dinâmicos e autenticação.
 * ============================================================
 */

// Fallbacks
$titulo_pagina = $titulo_pagina ?? 'Portfólio';
$pagina_atual  = $pagina_atual ?? '';
$caminho_raiz  = $caminho_raiz ?? './';
$nome_dev      = $nome_dev ?? 'NICOLAS HENRIQUE';

// Verifica se o usuário está logado
$logado = isset($_SESSION['usuario']);

// Classe ativa do menu
if (!function_exists('menu_ativo')) {
    function menu_ativo(string $item, string $pagina_atual): string
    {
        return ($item === $pagina_atual) ? 'active' : '';
    }
}
?>

<header>
    <nav class="main-nav">
        <div class="nav-container">

            <a href="<?= $caminho_raiz ?>index.php" class="nav-logo">
                <i class="fa-solid fa-laptop-code"></i>
                <?= htmlspecialchars($nome_dev) ?>
            </a>

            <ul class="nav-links">

                <li>
                    <a href="<?= $caminho_raiz ?>index.php"
                       class="<?= menu_ativo('home', $pagina_atual) ?>">
                        Início
                    </a>
                </li>

                <li>
                    <a href="<?= $caminho_raiz ?>sobre.php"
                       class="<?= menu_ativo('sobre', $pagina_atual) ?>">
                        Sobre
                    </a>
                </li>

                <li>
                    <a href="<?= $caminho_raiz ?>projetos.php"
                       class="<?= menu_ativo('projetos', $pagina_atual) ?>">
                        Projetos
                    </a>
                </li>

                <li>
                    <a href="<?= $caminho_raiz ?>catalogo.php"
                       class="<?= menu_ativo('catalogo', $pagina_atual) ?>">
                        Catálogo
                    </a>
                </li>

                <li>
                    <a href="<?= $caminho_raiz ?>contato.php"
                       class="<?= menu_ativo('contato', $pagina_atual) ?>">
                        Contato
                    </a>
                </li>

                <?php if ($logado): ?>

                    <li>
                        <a href="<?= $caminho_raiz ?>04_sessoes/painel.php"
                           class="<?= menu_ativo('painel', $pagina_atual) ?>">
                            Painel
                        </a>
                    </li>

                    <li>
                        <a href="<?= $caminho_raiz ?>04_sessoes/logout.php"
                           class="btn-sair-nav">
                            Sair
                        </a>
                    </li>

                <?php else: ?>

                    <li>
                        <a href="<?= $caminho_raiz ?>04_sessoes/login.php"
                           class="<?= menu_ativo('login', $pagina_atual) ?>">
                            Login
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>
    </nav>
</header>