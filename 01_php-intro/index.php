<?php
$nome = "Nicolas Henrique";
$curso = "Técnico em Informática";
$instituicao = "IFPR";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Início — <?php echo $nome; ?></title>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg, #0f172a, #1e293b);
  color: white;
}

nav {
  background: #0f172a;
  padding: 15px 25px;
  border-bottom: 2px solid #38bdf8;
}

nav a {
  color: white;
  text-decoration: none;
  margin-right: 20px;
  font-weight: bold;
}

nav a:hover {
  color: #38bdf8;
}

.container {
  max-width: 800px;
  margin: 60px auto;
  background: #1e293b;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 0 25px rgba(0,0,0,0.5);
}

h1 {
  margin-top: 0;
  color: #38bdf8;
}

p {
  line-height: 1.6;
}

.info {
  margin-top: 25px;
  font-size: 14px;
  opacity: 0.8;
}
</style>

</head>
<body>

<nav>
  <a href="index.php">🏠 Início</a>
  <a href="sobre.php">👤 Sobre</a>
  <a href="projetos.php">💻 Projetos</a>
</nav>

<div class="container">
  <h1>Portfólio Acadêmico</h1>

  <p>
    Olá! Meu nome é <strong><?php echo $nome; ?></strong>, tenho <strong>17 anos</strong>
    e sou estudante do <strong><?php echo $curso; ?></strong> no
    <strong><?php echo $instituicao; ?></strong>, campus Ponta Grossa.
    Atualmente estou no <strong>3º ano</strong>.
  </p>

  <p>
    Este portfólio foi desenvolvido como parte das atividades da disciplina
    de Desenvolvimento Web e representa minha evolução ao longo do curso.
    Aqui você encontrará páginas e exercícios que demonstram meu crescimento
    técnico e minha dedicação à área de Tecnologia da Informação.
  </p>

  <div class="info">
    Página gerada em: <?php echo date("09/03/2026"); ?>
  </div>
</div>

</body>
</html>