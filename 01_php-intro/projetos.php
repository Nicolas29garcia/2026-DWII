<?php
$nome = "Nicolas Henrique";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Projetos — <?php echo $nome; ?></title>

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

.projeto {
  margin-top: 20px;
  padding: 20px;
  background: #0f172a;
  border-radius: 10px;
  border-left: 4px solid #38bdf8;
}

.projeto h3{
  margin-top:0;
  color:#38bdf8;
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

<h1>Meus Projetos</h1>

<p>Aqui estão alguns projetos desenvolvidos durante o curso.</p>

<div class="projeto">
  <h3>🌐 Portfólio Acadêmico</h3>
  <p>Site desenvolvido em HTML, CSS e PHP para apresentar meu portfólio e atividades do curso.</p>
</div>

<div class="projeto">
  <h3>💻 Exercícios de Desenvolvimento Web</h3>
  <p>Conjunto de exercícios práticos realizados durante a disciplina de Desenvolvimento Web.</p>
</div>

</div>

</body>
</html>