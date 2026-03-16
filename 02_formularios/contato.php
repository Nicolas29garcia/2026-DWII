<?php

$nome = "Nicolas Henrique Garcia";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato – {$nome}";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<?php include "../includes/cabecalho.php"; ?>
<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0f172a,#1e293b);
color:white;
min-height:100vh;
}

.container{
max-width:900px;
margin:auto;
padding:40px;
}

form{
background:#1e293b;
padding:25px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.4);
}

label{
font-weight:bold;
}

input, textarea{
width:100%;
padding:12px;
margin-top:6px;
border-radius:6px;
border:none;
background:#0f172a;
color:white;
}

textarea{
resize:vertical;
}

button{
background:#38bdf8;
color:white;
border:none;
padding:12px 20px;
border-radius:6px;
cursor:pointer;
font-weight:bold;
}

button:hover{
background:#0ea5e9;
transform:scale(1.05);
}

h1{
color:#38bdf8;
}

</style>

</head>

<body>

<div class="container">

<h1>Contato</h1>

<p>Entre em contato comigo através do formulário abaixo.</p>

<form action="obrigado.php" method="POST">

<label>Nome</label>
<input type="text" name="nome" required>

<br><br>

<label>Email</label>
<input type="email" name="email" required>

<br><br>

<label>Mensagem</label>
<textarea name="mensagem" rows="5" required></textarea>

<br><br>

<button type="submit">Enviar</button>

</form>

</div>

<?php include "../includes/rodape.php"; ?>

</body>
</html>