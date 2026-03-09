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
<title>Sobre — <?php echo $nome; ?></title>

<style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(135deg, #0f172a, #111827);
  color: #f1f5f9;
}

/* NAV */
nav {
  background: rgba(15, 23, 42, 0.9);
  padding: 15px 40px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

nav a {
  color: #f1f5f9;
  text-decoration: none;
  margin-right: 25px;
  font-weight: 600;
}

nav a:hover {
  color: #38bdf8;
}

/* CONTAINER */
.container {
  max-width: 1000px;
  margin: 80px auto;
  background: rgba(30, 41, 59, 0.7);
  backdrop-filter: blur(15px);
  padding: 50px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  gap: 50px;
  box-shadow: 0 25px 50px rgba(0,0,0,0.6);
}

/* FOTO */
.profile-img {
  width: 250px;
  height: 250px;
  border-radius: 50%;
  object-fit: cover;
  border: 5px solid #38bdf8;
  box-shadow: 0 0 35px rgba(56,189,248,0.5);
  transition: 0.4s ease;
}

.profile-img:hover {
  transform: scale(1.05);
  box-shadow: 0 0 50px rgba(56,189,248,0.8);
}

/* TEXTO */
.text-content {
  flex: 1;
}

h1 {
  margin-top: 0;
  font-size: 38px;
  color: #38bdf8;
}

p {
  font-size: 17px;
  line-height: 1.7;
  margin-bottom: 18px;
}

strong {
  color: #ffffff;
}

/* BOTÃO */
.btn {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 25px;
  background: #38bdf8;
  color: #0f172a;
  border-radius: 8px;
  text-decoration: none;
  font-weight: bold;
  transition: 0.3s;
}

.btn:hover {
  background: #0ea5e9;
  transform: translateY(-3px);
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

  <img src="img/nicolas.jpg" alt="Foto de <?php echo $nome; ?>" class="profile-img">

  <div class="text-content">
    <h1>Sobre Mim</h1>

    <p>
      Tenho <strong>17 anos</strong> e sou estudante do 
      <strong><?php echo $curso; ?></strong> no 
      <strong><?php echo $instituicao; ?></strong>, campus Ponta Grossa. 
      Atualmente estou no <strong>3º ano</strong>.
    </p>

    <p>
      Sou apaixonado por tecnologia e busco constantemente evoluir na área
      de desenvolvimento. Ao longo do curso, venho adquirindo experiência
      prática em programação e construção de páginas web.
    </p>

    <p>
      Meu objetivo é continuar aprimorando minhas habilidades e futuramente
      atuar profissionalmente na área de Tecnologia da Informação.
    </p>

    <a href="index.php" class="btn">⬅ Voltar para Início</a>
  </div>

</div>

</body>
</html>