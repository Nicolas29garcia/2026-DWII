<?php

if (!isset($pagina_atual)) $pagina_atual = "";

function menu_class($item, $atual) {
    return ($item === $atual) ? 'class="ativo"' : '';
}

?>

<nav>

<a href="../index.php" <?php echo menu_class("inicio", $pagina_atual); ?>>
🏠 Início
</a>

<a href="../sobre.php" <?php echo menu_class("sobre", $pagina_atual); ?>>
👤 Sobre
</a>

<a href="../projetos.php" <?php echo menu_class("projetos", $pagina_atual); ?>>
🚀 Projetos
</a>

<a href="../../02_formularios/contato.php" <?php echo menu_class("contato", $pagina_atual); ?>>
📬 Contato
</a>

</nav>