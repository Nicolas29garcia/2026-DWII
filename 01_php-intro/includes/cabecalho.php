<nav>
  <a href="index.php">🏠 Início</a>
  <a href="sobre.php">👤 Sobre</a>
  <a href="projetos.php">💻 Projetos</a>
</nav>
<div class="hero">
  <h1><?php echo $nome; ?></h1>
  <p>
    <?php echo $curso; ?> — <?php echo $instituicao; ?>
    <?php if (isset($anoCurso)) { echo " | " . $anoCurso; } ?>
  </p>
</div>