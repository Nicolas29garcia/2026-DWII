<?php
// Configurações da Página
$titulo_pagina = "Sobre Mim — Nicolas Henrique";
$pagina_atual = "sobre";
$caminho_raiz = "../"; 

$nome = "Nicolas Henrique";
$curso = "Técnico em Informática";
$instituicao = "IFPR";

// Inclui o cabeçalho padronizado (abre o container)
include_once 'includes/cabecalho.php'; 
?>

<section class="section-card" style="display: flex; align-items: center; gap: 40px; flex-wrap: wrap;">

    <div class="foto-container" style="margin: 0; flex-shrink: 0;">
        <img src="img/nicolas.jpg" alt="Foto de <?= $nome; ?>" style="width: 220px; height: 220px; border-radius: 50%; border: 5px solid var(--primary-light); box-shadow: var(--shadow);">
    </div>

    <div class="text-content" style="flex: 1; min-width: 300px;">
        <h1 style="color: var(--primary); margin-bottom: 20px;">
            <i class="fa-solid fa-address-card"></i> Sobre Mim
        </h1>

        <p>
            Tenho <strong>17 anos</strong> e sou estudante do 
            <strong><?= $curso; ?></strong> no 
            <strong><?= $instituicao; ?></strong>, campus Ponta Grossa. 
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

        <div style="margin-top: 30px;">
            <a href="index.php" class="voltar">
                <i class="fa-solid fa-arrow-left"></i> Voltar para Início
            </a>
        </div>
    </div>

</section>

<?php 
// Inclui o rodapé padronizado (fecha o container e tags html)
include_once 'includes/rodape.php'; 
?>