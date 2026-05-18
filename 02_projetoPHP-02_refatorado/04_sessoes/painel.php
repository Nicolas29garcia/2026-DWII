<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo    : painel.php
 * Autor      : Nicolas Henrique
 * Descrição  : Área protegida do sistema após autenticação.
 * ============================================================
 */

// Proteção da sessão
require_once __DIR__ . '/includes/auth.php';
requer_login();

// Variáveis do template
$titulo_pagina = 'Painel do Sistema';
$caminho_raiz  = '../';
$pagina_atual  = 'painel';
$nome_dev      = 'NICOLAS';

// Cabeçalho global
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
/* =========================================================
   ESTILO DA ÁREA ADMINISTRATIVA
========================================================= */

.painel-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 45px 20px 70px;
}

/* TOPO */

.painel-topo {
    margin-bottom: 35px;
}

.painel-status {
    display: inline-block;
    background: #dcfce7;
    color: #166534;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.painel-topo h1 {
    font-size: 2.4rem;
    color: #0f172a;
    margin-bottom: 10px;
}

.painel-topo p {
    color: #64748b;
    font-size: 1rem;
}

/* GRID */

.painel-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 24px;
}

/* CARDS */

.painel-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    transition: 0.25s;
}

.painel-card:hover {
    transform: translateY(-4px);
}

.painel-card h2 {
    font-size: 1.25rem;
    color: #0f172a;
    margin-bottom: 14px;
}

.painel-card p {
    color: #64748b;
    line-height: 1.7;
}

/* STATUS BOX */

.status-box {
    margin-top: 18px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 18px;
    font-family: monospace;
    line-height: 1.8;
    color: #334155;
}

/* BOTÕES */

.painel-acoes {
    margin-top: 24px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-painel,
.btn-sair {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 18px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 800;
    transition: 0.25s;
}

.btn-painel {
    background: #2563eb;
    color: #ffffff;
}

.btn-painel:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

.btn-sair {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.btn-sair:hover {
    background: #fecaca;
    transform: translateY(-2px);
}

/* RESPONSIVO */

@media (max-width: 700px) {

    .painel-topo h1 {
        font-size: 1.9rem;
    }

    .painel-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<main class="painel-wrapper">

    <!-- TOPO -->

    <section class="painel-topo">

        <span class="painel-status">
            ✅ Sessão autenticada
        </span>

        <h1>
            Bem-vindo,
            <?= htmlspecialchars($_SESSION['usuario']) ?>
        </h1>

        <p>
            Você acessou a área administrativa protegida do sistema.
        </p>

    </section>

    <!-- GRID PRINCIPAL -->

    <section class="painel-grid">

        <!-- CARD STATUS -->

        <article class="painel-card">

            <h2>📊 Informações da Sessão</h2>

            <p>
                A autenticação foi realizada corretamente e sua sessão está ativa no servidor.
            </p>

            <div class="status-box">
                > STATUS: ONLINE <br>
                > USUÁRIO: <?= htmlspecialchars($_SESSION['usuario']) ?> <br>
                > LOGIN EM: <?= htmlspecialchars($_SESSION['logado_em'] ?? '-') ?> <br>
                > PHP: <?= phpversion() ?>
            </div>

        </article>

        <!-- CARD CRUD -->

        <article class="painel-card">

            <h2>📂 CRUD de Projetos</h2>

            <p>
                Acesse o sistema de gerenciamento completo dos projetos cadastrados no banco de dados.
            </p>

            <div class="painel-acoes">

                <a
                    href="/02_projetoPHP-02_refatorado/05_crud/index.php"
                    class="btn-painel"
                >
                    🚀 Abrir CRUD
                </a>

            </div>

        </article>

    </section>

    <!-- AÇÕES -->

    <div class="painel-acoes" style="margin-top: 35px;">

        <a href="logout.php" class="btn-sair">
    🚪 Encerrar Sessão
        </a>

    </div>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>