<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// -------- VARIÁVEIS DE CONTEÚDO ----------------------------
$pagina_atual = 'inicio';
$caminho_raiz = './';
$titulo_pagina = 'Portfólio - Nicolas';

// Dados de apresentação
$nome = 'Nicolas';
$descricao = 'Estudante de Desenvolvimento Web II (2026), trabalhando com PHP, HTML, CSS e integração com banco de dados. Este hub reúne as atividades e projetos desenvolvidos ao longo do curso.';
$email = 'seuemail@email.com';

// BASE URL (para links dos módulos)
$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

// Módulos
$modulos = [
    ["id"=>"00","titulo"=>"Apresentação Pessoal","tag"=>"HTML/CSS","arquivo"=>"00_apresentacao/index.html"],
    ["id"=>"01","titulo"=>"Portfólio Dinâmico","tag"=>"PHP Intro","arquivo"=>"01_php-intro/index.php"],
    ["id"=>"04","titulo"=>"Formulários e Filtros","tag"=>"Segurança","arquivo"=>"02_formularios/contato.php"],
    ["id"=>"05","titulo"=>"Integração com Banco","tag"=>"Database","arquivo"=>"03_pdo/index.php"],
    ["id"=>"06","titulo"=>"Gestão de Sessões","tag"=>"Auth","arquivo"=>"04_sessoes/login.php"],
    ["id"=>"07","titulo"=>"CRUD","tag"=>"Auth","arquivo"=>"05_crud/index.php"]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($titulo_pagina) ?></title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #10b981;
    --bg: #f1f5f9;
    --text: #0f172a;
    --border: #e2e8f0;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg);
    color: var(--text);
    padding: 40px 20px;
}

.wrapper { max-width: 800px; margin: 0 auto; }

/* APRESENTAÇÃO */
.apresentacao {
    display: flex;
    gap: 30px;
    align-items: center;
    margin-bottom: 50px;
    flex-wrap: wrap;
}

.foto-perfil {
    width: 150px;
    border-radius: 50%;
    border: 3px solid var(--primary);
}

.texto-container h2 {
    margin-bottom: 10px;
}

.info-cards {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.info-card {
    background: white;
    border: 1px solid var(--border);
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 0.85rem;
}

/* LISTA */
header {
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border);
}

.lista { display: grid; gap: 15px; }

.card {
    background: #fff;
    border: 1px solid var(--border);
    padding: 20px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    text-decoration: none;
    color: inherit;
    transition: 0.2s;
}

.card:hover {
    border-color: var(--primary);
    transform: translateX(8px);
}

.badge {
    font-size: 0.65rem;
    font-weight: 800;
    background: #ecfdf5;
    color: var(--primary);
    padding: 4px 8px;
    border-radius: 6px;
}

.tag {
    font-size: 0.8rem;
    color: #94a3b8;
    font-family: monospace;
}

footer {
    margin-top: 40px;
    text-align: center;
    font-size: 0.8rem;
    color: #94a3b8;
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- APRESENTAÇÃO -->
    <section class="apresentacao">

        <img src="<?= $caminho_raiz ?>00_apresentacao/imgs/foto.jpg"
             alt="Foto de <?= htmlspecialchars($nome) ?>"
             class="foto-perfil">

        <div class="texto-container">
            <h2>Olá, eu sou <?= htmlspecialchars($nome) ?> 👋</h2>
            <p><?= htmlspecialchars($descricao) ?></p>

            <div class="info-cards">
                <div class="info-card">🎓 IFPR</div>
                <div class="info-card">💻 Web II - 2026</div>
                <div class="info-card">📧 <?= htmlspecialchars($email) ?></div>
            </div>
        </div>

    </section>

    <!-- HEADER HUB -->
    <header>
        <h1><?= htmlspecialchars($nome) ?></h1>
        <p>Desenvolvimento Web II // 2026</p>
    </header>

    <!-- MÓDULOS -->
    <nav class="lista">
        <?php foreach ($modulos as $m): ?>
        <a href="<?= $base_url . $m['arquivo'] ?>" class="card">
            <div>
                <span class="badge">Aula <?= $m['id'] ?></span>
                <h3><?= htmlspecialchars($m['titulo']) ?></h3>
                <span class="tag">#<?= $m['tag'] ?></span>
            </div>
            <div>→</div>
        </a>
        <?php endforeach; ?>
    </nav>

    <footer>
        IFPR - Ponta Grossa | <?= date("Y") ?>
    </footer>

</div>

</body>
</html>