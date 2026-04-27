<?php
// Define a página atual caso não tenha sido definida no arquivo principal
if (!isset($pagina_atual)) $pagina_atual = "";

// Função para aplicar a classe 'active' no link selecionado
function menu_class($item, $atual) {
    return ($item === $atual) ? 'class="active"' : '';
}
?>

<ul class="nav-links">
    <li>
        <a href="<?= $caminho_raiz; ?>index.php" <?= menu_class("inicio", $pagina_atual); ?>>
            <i class="fa-solid fa-house-chimney"></i> Hub
        </a>
    </li>

    <li>
        <a href="<?= $caminho_raiz; ?>01_php-intro/sobre.php" <?= menu_class("sobre", $pagina_atual); ?>>
            <i class="fa-solid fa-user"></i> Sobre
        </a>
    </li>

    <li>
        <a href="<?= $caminho_raiz; ?>01_php-intro/projetos.php" <?= menu_class("projetos", $pagina_atual); ?>>
            <i class="fa-solid fa-code-branch"></i> Projetos
        </a>
    </li>

    <li>
        <a href="<?= $caminho_raiz; ?>03_pdo/index.php" <?= menu_class("catalogo", $pagina_atual); ?>>
            <i class="fa-solid fa-database"></i> Catálogo
        </a>
    </li>

    <li>
        <a href="<?= $caminho_raiz; ?>02_formularios/contato.php" <?= menu_class("contato", $pagina_atual); ?>>
            <i class="fa-solid fa-paper-plane"></i> Contato
        </a>
    </li>
</ul>