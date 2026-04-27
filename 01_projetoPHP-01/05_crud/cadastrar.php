<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 07 – CRUD: Create e Read
 * Arquivo    : 05_crud/cadastrar.php
 */

// --- Proteção: apenas usuários autenticados ---
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// --- Dependências ---
require_once __DIR__ . '/includes/conexao.php';

$erro = '';
$sucesso = '';

// Preserva os valores do formulário em caso de erro
$form = [
    'nome'        => '',
    'descricao'   => '',
    'tecnologias' => '',
    'link_github' => '',
    'ano'         => date('Y'),
];

// --- Processamento do POST ---
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
    } elseif ($form['ano'] < 2000 || $form['ano'] > (int) date('Y') + 1) {
        $erro = 'Ano inválido.';
    }

    if ($erro === '') {
        $pdo = conectar();

        $sql = 'INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano)
                VALUES (:nome, :descricao, :tecnologias, :link_github, :ano)';

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

$titulo_pagina = 'Cadastrar Projeto – Portfólio';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #eef2ff, #f3f4f6);
    color: #111827;
}

/* CONTAINER */
.container {
    max-width: 650px;
    margin: 50px auto;
    padding: 20px;
}

/* TÍTULO */
.titulo-secao {
    font-size: 26px;
    color: #3b579d;
    margin-bottom: 20px;
    text-align: center;
}

/* FORM CARD */
.form-container {
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: 0.2s;
}

.form-container:hover {
    transform: translateY(-3px);
}

/* LABEL */
label {
    font-size: 14px;
    font-weight: bold;
    display: block;
    margin-top: 12px;
    margin-bottom: 6px;
}

/* INPUTS */
input, textarea {
    width: 100%;
    padding: 11px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    transition: 0.2s;
}

/* FOCUS */
input:focus, textarea:focus {
    outline: none;
    border-color: #3b579d;
    box-shadow: 0 0 0 2px rgba(59,87,157,0.15);
}

/* BOTÃO */
button {
    width: 100%;
    margin-top: 18px;
    background: #3b579d;
    color: white;
    border: none;
    padding: 12px;
    font-size: 15px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s;
}

button:hover {
    background: #2f447a;
    transform: scale(1.02);
}

/* ALERTA ERRO */
.alerta-erro {
    background: #fee2e2;
    border: 1px solid #ef4444;
    color: #7f1d1d;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}

/* LINK */
a {
    text-decoration: none;
    font-weight: bold;
    color: #3b579d;
}

a:hover {
    text-decoration: underline;
}

</style>

</head>
<body>

<div class="container">

    <h1 class="titulo-secao">➕ Cadastrar Novo Projeto 🚀</h1>

    <?php if ($erro): ?>
        <div class="alerta-erro">
            <p>🚫 <?php echo htmlspecialchars($erro); ?></p>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form action="cadastrar.php" method="post">

            <label>📌 Nome do Projeto *</label>
            <input type="text" name="nome"
                value="<?php echo htmlspecialchars($form['nome']); ?>"
                placeholder="Ex: Sistema de Login">

            <label>📝 Descrição *</label>
            <textarea name="descricao" rows="4"
                placeholder="Descreva o projeto..."><?php echo htmlspecialchars($form['descricao']); ?></textarea>

            <label>🛠️ Tecnologias *</label>
            <input type="text" name="tecnologias"
                value="<?php echo htmlspecialchars($form['tecnologias']); ?>"
                placeholder="PHP, MySQL, HTML...">

            <label>🔗 GitHub (opcional)</label>
            <input type="url" name="link_github"
                value="<?php echo htmlspecialchars($form['link_github']); ?>"
                placeholder="https://github.com/...">

            <label>📅 Ano *</label>
            <input type="number" name="ano"
                value="<?php echo htmlspecialchars($form['ano']); ?>">

            <button type="submit">💾 Salvar Projeto 🚀</button>

        </form>
    </div>

    <p style="margin-top: 20px; text-align: center;">
        <a href="index.php">⬅️ Voltar para projetos</a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>