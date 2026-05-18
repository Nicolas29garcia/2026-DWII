<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 07 — CRUD: Create
 * Arquivo    : 05_crud/cadastrar.php
 * Autor      : Nicolas Henrique
 * Descrição  : Cadastro de novos projetos.
 */

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$erro = '';

$form = [
    'nome'        => '',
    'descricao'   => '',
    'tecnologias' => '',
    'link_github' => '',
    'ano'         => date('Y'),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form['nome']        = trim($_POST['nome'] ?? '');
    $form['descricao']   = trim($_POST['descricao'] ?? '');
    $form['tecnologias'] = trim($_POST['tecnologias'] ?? '');
    $form['link_github'] = trim($_POST['link_github'] ?? '');
    $form['ano']         = (int) ($_POST['ano'] ?? date('Y'));

    if ($form['nome'] === '') {
        $erro = 'O nome do projeto é obrigatório.';
    } elseif ($form['descricao'] === '') {
        $erro = 'A descrição é obrigatória.';
    } elseif ($form['tecnologias'] === '') {
        $erro = 'Informe ao menos uma tecnologia.';
    }

    if ($erro === '') {

        $pdo = conectar();

        $sql = '
            INSERT INTO projetos
            (nome, descricao, tecnologias, link_github, ano)
            VALUES
            (:nome, :descricao, :tecnologias, :link_github, :ano)
        ';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome'        => $form['nome'],
            ':descricao'   => $form['descricao'],
            ':tecnologias' => $form['tecnologias'],
            ':link_github' => $form['link_github'] !== '' ? $form['link_github'] : null,
            ':ano'         => $form['ano'],
        ]);

        header('Location: index.php?cadastro=ok');
        exit;
    }
}

$titulo_pagina = 'Cadastrar Projeto';
$caminho_raiz  = '../';
$pagina_atual  = '';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
    .form-page {
        padding: 35px 0 60px;
    }

    .form-header {
        margin-bottom: 28px;
    }

    .form-header h1 {
        color: #2563eb;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #64748b;
    }

    .btn-voltar-crud {
        display: inline-block;
        margin-bottom: 22px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 700;
    }

    .btn-voltar-crud:hover {
        text-decoration: underline;
    }

    .form-card {
        max-width: 760px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
    }

    .alerta-erro {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
        padding: 14px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: #334155;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 13px 14px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        font-size: 0.95rem;
        outline: none;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .btn-salvar {
        width: 100%;
        margin-top: 8px;
        border: none;
        border-radius: 14px;
        padding: 14px;
        background: #2563eb;
        color: #ffffff;
        font-weight: 800;
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-salvar:hover {
        background: #1d4ed8;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="form-page">

    <a href="index.php" class="btn-voltar-crud">
        ← Voltar para projetos
    </a>

    <div class="form-header">
        <h1>➕ Novo Projeto</h1>
        <p>Preencha os dados abaixo para cadastrar um projeto.</p>
    </div>

    <div class="form-card">

        <?php if ($erro): ?>
            <div class="alerta-erro">
                🚫 <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="cadastrar.php" method="post">

            <div class="form-group">
                <label for="nome">Nome do Projeto *</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($form['nome']) ?>"
                    placeholder="Ex: Sistema de Login"
                >
            </div>

            <div class="form-group">
                <label for="descricao">Descrição *</label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="4"
                    placeholder="Descreva brevemente o projeto..."
                ><?= htmlspecialchars($form['descricao']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="tecnologias">Tecnologias *</label>
                <input
                    type="text"
                    id="tecnologias"
                    name="tecnologias"
                    value="<?= htmlspecialchars($form['tecnologias']) ?>"
                    placeholder="PHP, MySQL, CSS..."
                >
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="link_github">GitHub opcional</label>
                    <input
                        type="url"
                        id="link_github"
                        name="link_github"
                        value="<?= htmlspecialchars($form['link_github']) ?>"
                        placeholder="https://github.com/..."
                    >
                </div>

                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input
                        type="number"
                        id="ano"
                        name="ano"
                        value="<?= htmlspecialchars($form['ano']) ?>"
                    >
                </div>

            </div>

            <button type="submit" class="btn-salvar">
                💾 Salvar Projeto
            </button>

        </form>

    </div>

</section>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>