<?php

$autor = isset($nome) ? htmlspecialchars($nome) : "Portfólio";

?>

<footer>

<?php echo $autor; ?>
&copy; <?php echo date("Y"); ?>
| Desenvolvido com PHP
| IFPR – Ponta Grossa

</footer>