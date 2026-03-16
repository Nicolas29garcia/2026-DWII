<?php
$nome = "Nicolas Henrique";
$curso = "Técnico em Informática";
$instituicao = "IFPR";

$paginas = [
[
"titulo" => "Início",
"descricao" => "Página principal do meu portfólio acadêmico.",
"link" => "01_php-intro/index.php",
"icone" => "🏠",
"cor" => "#38bdf8"
],
[
"titulo" => "Sobre",
"descricao" => "Conheça mais sobre mim, minha formação e objetivos.",
"link" => "01_php-intro/sobre.php",
"icone" => "👤",
"cor" => "#a855f7"
],
[
"titulo" => "Projetos",
"descricao" => "Projetos envolvendo desenvolvimento de bots para Discord e automação.",
"link" => "01_php-intro/projetos.php",
"icone" => "🤖",
"cor" => "#22c55e"
],
[
"titulo" => "Contato",
"descricao" => "Formulário para entrar em contato comigo.",
"link" => "02_formularios/contato.php",
"icone" => "✉️",
"cor" => "#f59e0b"
]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Portfólio — <?php echo $nome; ?></title>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0f172a,#1e293b);
color:white;
}

.container{
max-width:1100px;
margin:auto;
padding:40px;
}

h1{
color:#38bdf8;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-top:30px;
}

.card{
background:#1e293b;
padding:25px;
border-radius:12px;
text-decoration:none;
color:white;
box-shadow:0 0 20px rgba(0,0,0,0.4);
border-left:5px solid;
transition:0.2s;
}

.card:hover{
transform:translateY(-5px);
}

.icon{
font-size:28px;
margin-bottom:10px;
}

.card h3{
margin:0;
}

.card p{
font-size:14px;
opacity:0.8;
}

</style>
</head>

<body>

<div class="container">

<h1>Portfólio de <?php echo $nome; ?></h1>

<p>
Estudante de <strong><?php echo $curso; ?></strong> no
<strong><?php echo $instituicao; ?></strong>.
Desenvolvedor de bots para Discord e entusiasta de automação de sistemas.
</p>

<div class="grid">

<?php foreach($paginas as $pagina): ?>

<a class="card"
href="<?php echo $pagina['link']; ?>"
style="border-left-color: <?php echo $pagina['cor']; ?>">

<div class="icon"><?php echo $pagina['icone']; ?></div>

<h3><?php echo $pagina['titulo']; ?></h3>

<p><?php echo $pagina['descricao']; ?></p>

</a>

<?php endforeach; ?>

</div>

</div>

</body>
</html>