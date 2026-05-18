<?php
/**
 * ========================================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Central de Projetos Web
 * Arquivo    : catalogo.php
 * Autor      : Nicolas Henrique
 * Descrição  : Lista pública de tecnologias do banco de dados.
 * ========================================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pagina_atual = 'catalogo';
$titulo_pagina = 'Catálogo de Tecnologias | Nicolas Henrique';
$caminho_raiz = './';

require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

$stmt = $pdo->query(
    "SELECT * FROM tecnologias
     WHERE status = 'ativo'
     ORDER BY nome ASC"
);

$tecnologias = $stmt->fetchAll();

include __DIR__ . '/includes/cabecalho.php';
?>

<style>

/* =========================================================
   CORES
========================================================= */

:root {

    --primary:#2563eb;

    --primary-hover:#1d4ed8;

    --primary-light:#dbeafe;

    --bg:#f8fafc;

    --white:#ffffff;

    --text:#0f172a;

    --text-light:#475569;

    --border:#cbd5e1;

    --radius:18px;

    --shadow:0 15px 35px rgba(37,99,235,0.12);
}

/* =========================================================
   BODY
========================================================= */

body {

    margin:0;

    font-family:Arial, Helvetica, sans-serif;

    background:linear-gradient(135deg,#e0f2fe,#f8fafc);

    color:var(--text);
}

/* =========================================================
   HEADER / MENU
========================================================= */

header {

    background:#ffffff;

    padding:18px 40px;

    box-shadow:0 4px 18px rgba(37,99,235,0.10);

    text-align:center;
}

/* REMOVE LOGO NICOLAS */

header > a,
.logo {

    display:none !important;
}

/* MENU */

header nav ul {

    list-style:none;

    padding:0;

    margin:0;

    display:flex;

    justify-content:center;

    align-items:center;

    gap:16px;

    flex-wrap:wrap;
}

header nav ul li {

    margin:0;
}

header nav ul li a {

    display:inline-block;

    text-decoration:none;

    color:#0f172a;

    font-weight:700;

    padding:10px 18px;

    border-radius:12px;

    transition:0.3s;
}

header nav ul li a:hover {

    background:#dbeafe;

    color:#2563eb;
}

/* =========================================================
   CONTAINER
========================================================= */

.catalogo-container {

    max-width:900px;

    margin:70px auto;

    padding:20px;
}

/* =========================================================
   HEADER CATÁLOGO
========================================================= */

.catalogo-header {

    text-align:center;

    margin-bottom:40px;
}

.catalogo-header h1 {

    font-size:2.8rem;

    margin-bottom:10px;
}

.catalogo-header p {

    color:var(--text-light);

    font-size:1.05rem;
}

/* =========================================================
   INFO
========================================================= */

.catalogo-info {

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:22px;

    gap:15px;
}

.catalogo-info h2 {

    margin:0;

    font-size:1.5rem;
}

.contador {

    background:var(--primary-light);

    color:var(--primary);

    padding:8px 14px;

    border-radius:999px;

    font-weight:700;

    font-size:0.9rem;
}

/* =========================================================
   CARD
========================================================= */

.card {

    background:var(--white);

    border:1px solid var(--border);

    border-radius:var(--radius);

    padding:26px;

    margin-bottom:20px;

    box-shadow:var(--shadow);

    transition:0.3s ease;
}

.card:hover {

    transform:translateY(-5px);

    border-color:var(--primary);
}

/* =========================================================
   TOPO CARD
========================================================= */

.card-topo {

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;

    margin-bottom:12px;
}

.card h3 {

    margin:0;

    font-size:1.35rem;
}

/* =========================================================
   CATEGORIA
========================================================= */

.categoria {

    background:var(--primary-light);

    color:var(--primary);

    padding:6px 12px;

    border-radius:999px;

    font-size:0.85rem;

    font-weight:700;

    white-space:nowrap;
}

/* =========================================================
   DESCRIÇÃO
========================================================= */

.descricao {

    color:var(--text-light);

    line-height:1.7;

    margin-bottom:18px;
}

/* =========================================================
   BOTÃO
========================================================= */

.card-acoes {

    display:flex;

    justify-content:flex-end;
}

.btn-detalhes {

    background:linear-gradient(135deg,#2563eb,#1d4ed8);

    color:white;

    padding:12px 18px;

    border-radius:12px;

    text-decoration:none;

    font-weight:700;

    transition:0.3s;
}

.btn-detalhes:hover {

    transform:translateY(-2px);

    box-shadow:0 10px 20px rgba(37,99,235,0.25);
}

/* =========================================================
   CARD VAZIO
========================================================= */

.vazio {

    text-align:center;

    padding:45px 20px;

    color:var(--text-light);
}

.vazio .icone {

    font-size:3rem;

    margin-bottom:12px;
}

/* =========================================================
   VOLTAR
========================================================= */

.voltar {

    display:block;

    text-align:center;

    margin-top:35px;

    color:var(--primary);

    font-weight:700;

    text-decoration:none;
}

.voltar:hover {

    text-decoration:underline;
}

/* =========================================================
   FOOTER
========================================================= */

footer {

    text-align:center;

    padding:35px 20px;
}

/* =========================================================
   RESPONSIVO
========================================================= */

@media (max-width:768px) {

    .catalogo-container {

        margin:40px auto;
    }

    .catalogo-header h1 {

        font-size:2.1rem;
    }

    .catalogo-info,
    .card-topo {

        flex-direction:column;

        align-items:flex-start;
    }

    .card-acoes {

        justify-content:stretch;
    }

    .btn-detalhes {

        width:100%;

        text-align:center;
    }
}

</style>

<main class="catalogo-container">

    <!-- HEADER -->

    <div class="catalogo-header">

        <h1>Catálogo de Tecnologias</h1>

        <p>
            Confira as tecnologias cadastradas no banco de dados.
        </p>

    </div>

    <!-- INFO -->

    <div class="catalogo-info">

        <h2>Tecnologias disponíveis</h2>

        <span class="contador">

            <?= count($tecnologias); ?> tecnologia(s)

        </span>

    </div>

    <!-- TECNOLOGIAS -->

    <?php if (empty($tecnologias)): ?>

        <div class="card vazio">

            <div class="icone">📁</div>

            <p>
                Nenhuma tecnologia ativa encontrada.
            </p>

        </div>

    <?php else: ?>

        <?php foreach ($tecnologias as $tec): ?>

            <article class="card">

                <div class="card-topo">

                    <h3>
                        <?= htmlspecialchars($tec['nome']); ?>
                    </h3>

                    <span class="categoria">
                        <?= htmlspecialchars($tec['categoria']); ?>
                    </span>

                </div>

                <p class="descricao">

                    <?= htmlspecialchars($tec['descricao']); ?>

                </p>

                <div class="card-acoes">

                    <a
                        href="detalhe.php?id=<?= (int)$tec['id']; ?>"
                        class="btn-detalhes"
                    >
                        Ver detalhes →
                    </a>

                </div>

            </article>

        <?php endforeach; ?>

    <?php endif; ?>

    <!-- VOLTAR -->

    <a href="index.php" class="voltar">

        ← Voltar ao início

    </a>

</main>

<?php include __DIR__ . '/includes/rodape.php'; ?>