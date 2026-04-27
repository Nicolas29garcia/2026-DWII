<?php
// Configurações da Página
$titulo_pagina = "Projetos — Nicolas Henrique";
$pagina_atual = "projetos";
$caminho_raiz = "../"; 

$nome = "Nicolas Henrique";

// Inclui o cabeçalho padronizado
include_once 'includes/cabecalho.php'; 
?>

<section class="section-card">
    <h1><i class="fa-solid fa-code-merge"></i> Meus Projetos</h1>
    <p>Aqui estão alguns projetos desenvolvidos durante o curso de informática.</p>

    <div class="projeto" style="margin-top: 20px; padding: 20px; background: var(--bg); border-radius: 10px; border-left: 5px solid var(--primary);">
        <h3 style="margin-top:0; color: var(--primary);">
            <i class="fa-solid fa-globe"></i> Portfólio Acadêmico
        </h3>
        <p style="margin-bottom:0;">Site desenvolvido em HTML, CSS e PHP para apresentar meu portfólio e atividades do curso.</p>
    </div>

    <div class="projeto" style="margin-top: 20px; padding: 20px; background: var(--bg); border-radius: 10px; border-left: 5px solid var(--primary);">
        <h3 style="margin-top:0; color: var(--primary);">
            <i class="fa-solid fa-laptop-code"></i> Exercícios de Desenvolvimento Web
        </h3>
        <p style="margin-bottom:0;">Conjunto de exercícios práticos realizados durante a disciplina de Desenvolvimento Web II.</p>
    </div>

    <div class="projeto" style="margin-top: 20px; padding: 20px; background: var(--bg); border-radius: 10px; border-left: 5px solid var(--primary);">
        <h3 style="margin-top:0; color: var(--primary);">
            <i class="fa-solid fa-database"></i> Sistema de Catálogo (PDO)
        </h3>
        <p style="margin-bottom:0;">Implementação de CRUD utilizando PHP e conexão segura com banco de dados MySQL.</p>
    </div>
</section>

<?php 
// Inclui o rodapé padronizado
include_once 'includes/rodape.php'; 
?>