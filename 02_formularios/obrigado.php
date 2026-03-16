<?php

$nome = "Nicolas Henrique Garcia";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Mensagem enviada – {$nome}";

$nome_form = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<?php include "../includes/cabecalho.php"; ?>

<style>

body{
margin:0;
font-family:Arial, sans-serif;
background:linear-gradient(135deg,#0f172a,#1e293b);
color:white;
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.container{
max-width:700px;
width:100%;
padding:40px;
}

.resultado{
background:#1e293b;
padding:35px;
border-radius:14px;
box-shadow:0 15px 40px rgba(0,0,0,0.5);
border-left:6px solid #22c55e;
animation:fade 0.5s ease;
}

h1{
color:#22c55e;
margin-top:0;
}

p{
line-height:1.6;
}

.voltar{
display:inline-block;
margin-top:20px;
background:#38bdf8;
color:white;
padding:12px 22px;
border-radius:8px;
text-decoration:none;
font-weight:bold;
transition:0.2s;
}

.voltar:hover{
background:#0ea5e9;
transform:translateY(-2px);
box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

@keyframes fade{
from{
opacity:0;
transform:translateY(20px);
}
to{
opacity:1;
transform:translateY(0);
}
}

</style>

</head>

<body>

<div class="container">

<h1>Mensagem enviada!</h1>

<div class="resultado">

<p><strong>Nome:</strong> <?php echo htmlspecialchars($nome_form); ?></p>

<p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

<p><strong>Mensagem:</strong></p>

<p><?php echo nl2br(htmlspecialchars($mensagem)); ?></p>

<a class="voltar" href="contato.php">Voltar</a>

</div>

</div>

<?php include "../includes/rodape.php"; ?>

</body>
</html>